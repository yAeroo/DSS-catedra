import jQuery from 'jquery';
window.$ = jQuery;
window.jQuery = jQuery;

import 'jquery-mask-plugin';

import iziToast from 'izitoast';
import 'izitoast/dist/css/iziToast.min.css';
window.iziToast = iziToast;

function mostrarSeccion(seccion, botonActivo) {
    // Ocultar todas las secciones
    $("#conConvenios, #sinConvenios").addClass("hidden");
    $("#" + seccion).removeClass("hidden");

    // Quitar clase activa de todos los botones
    document.querySelectorAll(".seccion-btn").forEach(btn => {
        btn.classList.remove("bg-title", "text-white");
        btn.classList.add("bg-white", "text-gray-700");
    });

    // Agregar clase activa al botón clicado
    botonActivo.classList.remove("bg-white", "text-gray-700");
    botonActivo.classList.add("bg-title", "text-white");
}

window.mostrarSeccion = mostrarSeccion;

//funcionalidad de boton recargar
function restablecerFiltros() {
        document.getElementById('busqueda').value = '';
        document.getElementById('filtroListado').selectedIndex = 0;
}

window.restablecerFiltros = restablecerFiltros;

//abrir modal
document.querySelectorAll('[data-open-modal]').forEach(btn => {
    btn.addEventListener('click', () => {
        const modalId = btn.getAttribute('data-open-modal');
        const modal = document.querySelector(`[data-modal-id="${modalId}"]`);
        if (modal) {
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100', 'pointer-events-auto');
            let convenioId = modal.dataset.convenioId = btn.closest('tr')?.dataset.id;

            if (modal.classList.contains('modal-details')) {
                $.detailsModal(convenioId);
            }else if (modal.classList.contains('modal-edit')) {
                $.editModal(convenioId);
            }else if (modal.classList.contains('modal-delete')) {
                $.deleteModal(convenioId);
            }else if (modal.classList.contains('modal-upload')) {
                $.uploadModal(convenioId);
            }
        }
    });
});

// Cerrar cualquier modal
document.querySelectorAll('[data-close-modal]').forEach(btn => {
    btn.addEventListener('click', () => {
        const modal = btn.closest('.transit');
        if (modal) {
            modal.classList.remove('opacity-100', 'pointer-events-auto');
            modal.classList.add('opacity-0', 'pointer-events-none');
        }
    });
});

$(document).on('change', '#tipo_empresa', function () {
    const tipoEmpresaId = $(this).find(':selected').val();
    const $empresaSelect = $('select[name="empresa"]');
    let hasOptions = false;

    $empresaSelect.find('option').each(function () {
        const optionTipoEmpresaId = $(this).data('type');
        if (optionTipoEmpresaId == tipoEmpresaId) {
            $(this).show();
            hasOptions = true;
        } else {
            $(this).hide();
        }
    });

    if (hasOptions) {
        $empresaSelect.prop('disabled', false);
        $empresaSelect.find('option:first').text('Seleccionar');
        $empresaSelect.val('');
    } else {
        $empresaSelect.prop('disabled', true);
        $empresaSelect.find('option:first').text('—');
        $empresaSelect.val('');
    }
});

$(document).on('change', '#edit_tipo_empresa', function () {
    const tipoEmpresaId = $(this).find(':selected').val();
    const $empresaSelect = $('#edit_empresa');
    let hasOptions = false;

    $empresaSelect.find('option').each(function () {
        const optionTipoEmpresaId = $(this).data('type');
        if (optionTipoEmpresaId == tipoEmpresaId) {
            $(this).show();
            hasOptions = true;
        } else {
            $(this).hide();
        }
    });

    if (hasOptions) {
        $empresaSelect.prop('disabled', false);
        $empresaSelect.find('option:first').text('Seleccionar');
        $empresaSelect.val('');
    } else {
        $empresaSelect.prop('disabled', true);
        $empresaSelect.find('option:first').text('—');
        $empresaSelect.val('');
    }
});

$(document).on('click', '#btnAgregar', function (e) {
    e.preventDefault();

    let inputs = $('#formAgregarConvenio').find('input, select, textarea');
    let isValid = true;

    $.each(inputs, function (index, input) {
        if(input.value === '') {
            if(input.name == 'fecha_finalizacion' && $('#situacion_actual').val() == 'activo') {
                $(input).removeClass('!border-red-500');
            }else{
                $(input).addClass('!border-red-500');
                isValid = false;
            }
        }
        else {
            $(input).removeClass('!border-red-500');
        }
    })

    if(!isValid) {
        iziToast.error({
            title: '¡Error!',
            message: 'Complete todos los campos obligatorios.',
            icon: 'fa-solid fa-triangle-exclamation',
            progressBar: false,
            layout: 2,
        });
        return;
    }else{
        $('#formAgregarConvenio').submit();
    }
});

$(document).on('click', '#btnActualizar', function (e) {
    e.preventDefault();

    let inputs = $('#formActualizarConvenio').find('input, select, textarea');
    let isValid = true;

    $.each(inputs, function (index, input) {
        if(input.value === '') {
            if(input.id == 'edit_fecha_finalizacion' && $('#edit_situacion_actual').val() == 'activo') {
                $(input).removeClass('!border-red-500');
            }else{
                $(input).addClass('!border-red-500');
                isValid = false;
            }
        }
        else {
            $(input).removeClass('!border-red-500');
        }
    })

    if(!isValid) {
        iziToast.error({
            title: '¡Error!',
            message: 'Complete todos los campos obligatorios.',
            icon: 'fa-solid fa-triangle-exclamation',
            progressBar: false,
            layout: 2,
        });
        return;
    }else{
        $('#formActualizarConvenio').submit();
    }
});

$(document).on('change', '#file-convenio', function () {
    const fileName = $(this).val().split('\\').pop();
    if(fileName) {
        $('#file-convenio-label').text(fileName);
    }
    else {
        $('#file-convenio-label').text('Seleccionar archivo');
    }
});

$(document).on('click', '#btnGuardarArchivo', function (e) {
    e.preventDefault();

    if($('#file-convenio').val() == '') {
        iziToast.error({
            title: '¡Error!',
            message: 'Seleccione un archivo.',
            icon: 'fa-solid fa-triangle-exclamation',
            progressBar: false,
            layout: 2,
        });
        return;
    }else{
        $('#formSubirArchivo').submit();
    }
})



$.extend({
    detailsModal: function (convenioId) {
        $.getJSON('/convenio_details/' + convenioId, function(data) {
            console.log(data);
            $('#abreviatura').text(data.empresa.abreviatura_empresa);
            $('#nombre_empresa').text(data.empresa.nombre_empresa);
            $('#codigo_donante').text(data.empresa.codigo_donante);
            $('#estado_empre').text(data.empresa.estado);
            $('#tipo_operacion').text(data.empresa.tipo_cooperacion);
            $('#tipo_relacion').text(data.empresa.tipo_relacion);
            $('#tipo_empresa_det').text(data.empresa.tipo_empresa.nombre);
            $('#direccion_det').text(data.empresa.direccion);

            $('#sede_det').text(data.sede);
            $('#correo_det').text(data.correo_contacto);
            $('#nombre_contacto_det').text(data.nombre_contacto);
            $('#situacion_actual_det').text(data.estado);
            $('#numero_contacto_det').text(data.telefono_contacto);
            $('#fecha_inicio_det').text(data.fecha_inicio);
            $('#fecha_finalizacion_det').text(data.fecha_fin ?? 'No definido');
            $('#convenio_det').text(data.convenio_detalle);

            if(data.estado_evidencia){
                $('#respaldo_doc').show();
                $('#respaldo_doc_no').hide();
                $('#btnDescargar').show().find('a').attr('href', '/convenio_download/' + convenioId);
            }else{
                $('#respaldo_doc').hide();
                $('#respaldo_doc_no').show();
                $('#btnDescargar').hide();
            }

            // Formatear fechas a dd-mm-YYYY hh:mm
            function formatDate(dateString) {
                if (!dateString) return '';
                const date = new Date(dateString);
                const pad = n => n.toString().padStart(2, '0');
                return `${pad(date.getDate())}-${pad(date.getMonth() + 1)}-${date.getFullYear()} ${pad(date.getHours())}:${pad(date.getMinutes())}`;
            }

            $('#fecha_registro_det').text(formatDate(data.created_at));
            $('#fecha_modificacion_det').text(formatDate(data.updated_at));
        });
    },

    editModal: function (convenioId) {
        $.getJSON('/convenio_details/' + convenioId, function(data) {
            console.log(data);
            $('#convenioId').val(convenioId);

            $('#edit_tipo_empresa').val(data.empresa.tipo_empresa_id).change();
            $('#edit_empresa').val(data.empresa_id).change();
            $('#edit_sede').val(data.sede);
            $('#edit_correo').val(data.correo_contacto);
            $('#edit_nombre_contacto').val(data.nombre_contacto);
            $('#edit_situacion_actual').val(data.estado);
            $('#edit_numero_contacto').val(data.telefono_contacto);
            $('#edit_fecha_inicio').val(data.fecha_inicio);
            $('#edit_fecha_finalizacion').val(data.fecha_fin ?? '');
            $('#edit_convenio').val(data.convenio_detalle);
            $('#edit_respaldo_doc').val(data.respaldo_doc);
            $('#edit_situacion_actual').val(data.estado);
            $('#edit_tipo_convenio').val(data.tipo_convenio);

            $('#edit_documentacion').prop('checked', data.convenio_respaldado);
        });
    },

    deleteModal: function (convenioId) {
        $('#convenioIdEliminar').val(convenioId);
    },

    uploadModal: function (convenioId) {
        $('#convenioIdSubirArchivo').val(convenioId);
    }
})
