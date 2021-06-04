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

    // Contact

    const contactForm = document.getElementById('contact-form')
    const fields = document.querySelectorAll('.form-control')
    const btnContactForm = document.getElementById('btnContactForm')
    const spinnerContactForm = document.getElementById('spinnerContactForm')
    const modal = new bootstrap.Modal(document.getElementById('modal'))
    const modalTitle = document.getElementById('modalTitle')
    const modalBody = document.getElementById('modalBody')

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

    contactForm.addEventListener('submit', async e => {
        e.preventDefault()

        btnContactForm.disabled = true
        spinnerContactForm.classList.remove('d-none')

        // Validation 
        isValid = true
        fields.forEach(f => {
            if (f.value === '') {
                f.classList.add('is-invalid')
                isValid = false
            } else {
                f.classList.add('is-valid')
            }
        })

        // is valid
        if( isValid ) {
            let formData = new FormData(contactForm)
            formData.append('action', 'pf_contact')
    
            let response = await fetch(window.MyAjax.ajaxurl, {
                method: 'POST',
                body: formData
            })
    
            let result = await response.json()
            if ( ! result.error ) {
                modalTitle.innerText = 'Заявка принята!'
                modalBody.innerText = `Ваша заявка зарегистрирована под номером ${result.id}`
                modal.show()

                e.target.reset()
                fields.forEach( f => f.classList.remove('is-valid') )
            }
            else {
                console.error( result.msg )
            }    
        }
        
        btnContactForm.disabled = false
        spinnerContactForm.classList.add('d-none')
    })

    // Work
    baguetteBox.run('.gallery')
})

