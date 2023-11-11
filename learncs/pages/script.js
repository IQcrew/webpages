function changeColor(element) {

    // var images = document.querySelectorAll('.image-container img');
    // images.forEach(img => {
    //     img.style.boxShadow = 'none';
    // });

    if (element.id === "right") {
        element.style.boxShadow = '0 0 20px rgba(0, 255, 0, 1)'; // Green shadow for "right"
        element.style.transform = 'scale(2)'; // Increase size for "right"
    } else {
        element.style.boxShadow = '0 0 20px rgba(255, 0, 0, 1)'; // Red shadow for others
        element.style.transform = 'scale(1)';
    }
}
