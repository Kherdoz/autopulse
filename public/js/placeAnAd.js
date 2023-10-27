$(document).ready(function () {
    // Surveille les champs de formulaire (input, select, textarea) lors de la saisie
    $('input, select, textarea').on('input', function () {
        const field = $(this);
        const id = field.attr('name'); // ID du champ
        const value = field.val().trim(); // Valeur du champ, sans les espaces vides

        if (value !== '') {
            // Si le champ n'est pas vide, ajoute un message de succès
            addSuccessMessage(field, id);
        } else {
            // Si le champ est vide, ajoute un message d'erreur
            addErrorMessage(field, id);
        }
    });

    // Cette fonction ajoute un message de succès pour un champ donné
    function addSuccessMessage(field, id) {
        removeErrorMessage(field, id); // Supprime tout message d'erreur existant
        const successDiv = $(`div[role="alert"][data-success="${id}"]`);
        if (!successDiv.length) {
            const successMessage = field.attr('data-success-message');
            const newSuccessDiv = $('<div>').attr('role', 'alert').attr('data-success', id).addClass('rounded border-s-4 border-green-500 bg-green-50 p-4 mb-4');
            newSuccessDiv.html(`<p class="mt-2 text-sm text-green-700">${successMessage}</p>`);
            field.after(newSuccessDiv);
        }
    }

    // Cette fonction ajoute un message d'erreur pour un champ donné
    function addErrorMessage(field, id) {
        removeSuccessMessage(field, id); // Supprime tout message de succès existant
        const errorDiv = $(`div[role="alert"][data-error="${id}"]`);
        if (!errorDiv.length) {
            const errorMessage = field.attr('data-error-message');
            const newErrorDiv = $('<div>').attr('role', 'alert').attr('data-error', id).addClass('rounded border-s-4 border-red-500 bg-red-50 p-4 mb-4');
            newErrorDiv.html(`<p class="mt-2 text-sm text-red-700">${errorMessage}</p>`);
            field.after(newErrorDiv);
        }
    }

    // Cette fonction supprime un message de succès pour un champ donné
    function removeSuccessMessage(field, id) {
        const successDiv = $(`div[role="alert"][data-success="${id}"]`);
        if (successDiv.length) {
            successDiv.remove();
        }
    }

    // Cette fonction supprime un message d'erreur pour un champ donné
    function removeErrorMessage(field, id) {
        const errorDiv = $(`div[role="alert"][data-error="${id}"]`);
        if (errorDiv.length) {
            errorDiv.remove();
        }
    }
});
