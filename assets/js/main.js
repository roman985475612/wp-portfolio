window.addEventListener('DOMContentLoaded', () => {

    const mainHeader = document.getElementById('main-header')

    mainHeader.addEventListener('click', e => {
        el = null

        if (e.target.parentNode.classList.contains('port-item')) {
            el = e.target.parentNode
        }

        if (e.target.classList.contains('port-item')) {
            el = e.target
        }

        if (el) {
            document.querySelector('.port-item.active')
                .classList
                .remove('active')

            document.querySelector('.tab-section.active')
                    .classList
                    .remove('active')

            el.classList.add('active')

            document.getElementById(el.dataset.section)
                    .classList
                    .add('active')
        }
    })

    // Contact

    const contactForm = document.getElementById('contact-form')
    const fields = contactForm.querySelectorAll('.form-control')
    const btnContactForm = document.getElementById('btnContactForm')
    const spinnerContactForm = document.getElementById('spinnerContactForm')
    const modal = new bootstrap.Modal(document.getElementById('modal'))
    const modalTitle = document.getElementById('modalTitle')
    const modalBody = document.getElementById('modalBody')

    const patterns = {
        notEmpty: /.+/,
        email: /^.+@.+\..+$/
    }

    contactForm.addEventListener('focusin', e => {
        if (e.target.classList.contains('form-control')) {
            e.target.classList.remove('is-invalid')
            e.target.classList.remove('is-valid')
        }
    })

    contactForm.addEventListener('submit', async e => {
        e.preventDefault()

        btnContactForm.disabled = true
        spinnerContactForm.classList.remove('d-none')

        // Validation 
        isValid = true
        fields.forEach(f => {
            let pattern = patterns[f.dataset.valid]
            f.value = f.value.trim()
            
            if( pattern.test( f.value ) ) {
                f.classList.add('is-valid')
            } else {
                f.classList.add('is-invalid')
                isValid = false
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
            if ( result.is_valid ) {
                modalTitle.innerText = 'Заявка принята!'
                modalBody.innerText = `Ваша заявка зарегистрирована под номером ${result.id}`
                modal.show()

                e.target.reset()
                fields.forEach( f => f.classList.remove('is-valid') )
            }
            else {
                for (var key in result.errors) {
                    let field = document.querySelector('#' + key)
                    field.classList.add('is-invalid')

                    let validation = document.querySelector('#' + key + 'Validation')
                    validation.innerText = result.errors[key]
                }
            }    
        }
        
        btnContactForm.disabled = false
        spinnerContactForm.classList.add('d-none')
    })

    // Work
    baguetteBox.run('.gallery')
})

