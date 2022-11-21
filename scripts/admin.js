const feedbackMenu = document.querySelector("#feedback-menu")
const feedbackContainer = document.querySelector(".feedback-container")
const packagesMenu = document.querySelector("#packages-menu")
const packagesContainer = document.querySelector(".packages-container")

feedbackMenu.addEventListener('click', () => { 
    packagesContainer.classList.add("none")
    feedbackContainer.classList.remove("none")

    feedbackMenu.classList.add("colored")
    feedbackMenu.classList.remove("uncolored")
    packagesMenu.classList.add("uncolored")
    packagesMenu.classList.remove("colored")
})

packagesMenu.addEventListener('click', () => { 
    packagesContainer.classList.remove("none")
    feedbackContainer.classList.add("none")

    feedbackMenu.classList.add("uncolored")
    feedbackMenu.classList.remove("colored")
    packagesMenu.classList.add("colored")
    packagesMenu.classList.remove("uncolored")
})

