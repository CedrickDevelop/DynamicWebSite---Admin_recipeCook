(function() {
    $('.range').next().text('2'); // Valeur par défaut
    $('.range').on('input', function() {
        var $set = $(this).val();
        $(this).next().text($set);
    });
});