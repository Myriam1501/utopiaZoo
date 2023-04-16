const threshold = .1
const options = {
    root: null,
    rootMargin: '0px',
    threshold
}

const handleIntersect = function (entries, observer) {
    entries.forEach(function (entry) {
        if (entry.intersectionRatio > threshold){
            entry.target.classList.remove('appear')
            observer.unobserve(entry.target)
        }
    })
}

document.documentElement.classList.add('appear-loaded')
window.addEventListener("DOMContentLoaded", function () {
    const observer = new IntersectionObserver(handleIntersect, options)
    const targets = document.querySelectorAll('.appear')
    targets.forEach(function (target) {
        observer.observe(target)
    })
})

let counter=1;
setInterval(function(){
    document.getElementById('radio'+ counter).checked=true;
    counter++;
    if(counter>4){
        counter=1;
    }
},5000);