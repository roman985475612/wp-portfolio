window.addEventListener('DOMContentLoaded', () => {

    const tabList = document.querySelectorAll('.port-item')
    const tabSection = document.querySelectorAll('.tab-section');

    tabList.forEach(i => i.addEventListener('click', showTab))

    function showTab() {
        hideSections()

        this.classList.add('active')

        document.getElementById(this.dataset.section)
                .classList
                .add('active')
    }

    function hideSections() {
        tabList.forEach(t => t.classList.remove('active'))
        tabSection.forEach(s => s.classList.remove('active'))
    }

    const contactForm = document.getElementById('contact-form')
    const fields = document.querySelectorAll('.form-control')

    fields.forEach(f => f.addEventListener('change', validateField))

    function validateField() {
        if (this.value === '') {
            if (this.classList.contains('is-valid')) {
                this.classList.remove('is-valid')
            }
            this.classList.add('is-invalid')
        } else {
            if (this.classList.contains('is-invalid')) {
                this.classList.remove('is-invalid')
            }
            this.classList.add('is-valid')
        }

    }

    contactForm.addEventListener('submit', e => {
        e.preventDefault()

        fields.forEach(f => {
            if (f.value === '') {
                f.classList.add('is-invalid')
            } else {
                f.classList.add('is-valid')
            }
        })
    })

    baguetteBox.run('.gallery')
})

