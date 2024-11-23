
if (window.innerWidth < 768) {
	[].slice.call(document.querySelectorAll('[data-bss-disabled-mobile]')).forEach(function (elem) {
		elem.classList.remove('animated');
		elem.removeAttribute('data-bss-hover-animate');
		elem.removeAttribute('data-aos');
		elem.removeAttribute('data-bss-parallax-bg');
		elem.removeAttribute('data-bss-scroll-zoom');
	});
}

document.addEventListener('DOMContentLoaded', function() {
}, false);

 // Create the floating button dynamically
 const floatingButton = document.createElement('a');
 floatingButton.href = '../menu.html';
 floatingButton.className = 'btn btn-info floating-button';
 floatingButton.textContent = 'menu';

 // Append the button to the body
 document.body.appendChild(floatingButton);
 const customCSS = document.createElement('style');
 customCSS.textContent = `
            /* Custom CSS for the floating button */
            .floating-button {
                position: fixed;
                bottom: 50%;
                transform: translateY(50%);
                z-index: 1000;
                width: 60px;
                height: 60px;
                right:0;
                text-align:center;
                border-radius:5%; /* To create a circular button */
                color: #fff; /* Text color, change as needed */
                line-height: 50px; /* Vertically center text */
            }
        `;

        // Append the style element to the document's head
document.head.appendChild(customCSS);