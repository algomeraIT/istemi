document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('flux\\:icon.document-duplicate').forEach(function(icon) {
        icon.addEventListener('click', function() {
            var email = icon.getAttribute('data-email');
            copyToClipboard(email);
        });
    });

    function copyToClipboard(text) {
        var textArea = document.createElement('textarea');
        textArea.value = text;
        
        document.body.appendChild(textArea);
        
        textArea.select();
        textArea.setSelectionRange(0, 99999); // For mobile devices
        
        document.execCommand('copy');
        
        document.body.removeChild(textArea);
        
        alert('Email copied to clipboard!');
    }
});