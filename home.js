function handleScroll() {
    const animatedElements = document.querySelectorAll('.donerP, .form');
    const animatedElements2 = document.querySelectorAll('.SImage');
    const animatedElements3 = document.querySelectorAll('.appointbtn');
    const animatedElements4 = document.querySelectorAll('.AImage');

    const scrollPosition = window.scrollY;
    const threshold = window.innerHeight * 0.9;

    let secondSetVisible = false;

    animatedElements.forEach(animatedElement => {
        const elementPosition = animatedElement.offsetTop;

        if (scrollPosition > elementPosition - threshold && !animatedElement.classList.contains('donerAni')) {
            animatedElement.classList.add('donerAni');
        }
    });

    animatedElements2.forEach(animatedElement => {
        const elementPosition = animatedElement.offsetTop;

        if (scrollPosition > elementPosition - threshold && !animatedElement.classList.contains('donerAni2')) {
            animatedElement.classList.add('donerAni2');
        }
    });

    if (scrollPosition > threshold) {
        secondSetVisible = true;
    }

    if (secondSetVisible) {
        animatedElements3.forEach(animatedElement => {
            const elementPosition = animatedElement.offsetTop;

            if (scrollPosition > elementPosition - threshold && !animatedElement.classList.contains('appointAni')) {
                animatedElement.classList.add('appointAni');
            }
        });

        animatedElements4.forEach(animatedElement => {
            const elementPosition = animatedElement.offsetTop;

            if (scrollPosition > elementPosition - threshold && !animatedElement.classList.contains('appointAni2')) {
                animatedElement.classList.add('appointAni2');
            }
        });
    }
}

// Add scroll event listener
window.addEventListener('scroll', handleScroll);
