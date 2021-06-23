<form id="contact-form" class="needs-validation" novalidate>
    <div class="input-group input-group-lg my-3 has-validation">
        <span class="input-group-text" id="_name">
            <i class="fas fa-user"></i>
        </span>
        <input
            id="name" 
            name="name" 
            type="text" 
            class="form-control" 
            placeholder="Name" 
            required aria-label="Name" 
            aria-describedby="name"
            data-valid="notEmpty"
        >
        <div id="nameValidation" class="invalid-feedback"></div>
    </div>

    <div class="input-group input-group-lg my-3">
        <span class="input-group-text" id="_email">
            <i class="fas fa-envelope"></i>
        </span>
        <input 
            id="email" 
            name="email" 
            type="email" 
            class="form-control" 
            placeholder="E-mail" 
            required 
            aria-label="Email" 
            aria-describedby="email"
            data-valid="email"
        >
        <div id="emailValidation" class="invalid-feedback"></div>
    </div>

    <div class="input-group input-group-lg my-3">
        <span class="input-group-text" id="_msg">
            <i class="fas fa-pencil-alt"></i>
        </span>
        <textarea 
            id="msg" 
            name="msg" 
            class="form-control" 
            placeholder="Message" 
            required 
            aria-label="With textarea"
            data-valid="notEmpty"
        ></textarea>
        <div id="msgValidation" class="invalid-feedback"></div>
    </div>
    <div class="d-grid gap-2">
        <button id="btnContactForm" type="submit" class="btn btn-danger btn-lg text-white text-capitalize">
            <span id="spinnerContactForm" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            Submit
        </button>
    </div>
</form>
