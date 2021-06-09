
        <footer id="main-footer" class="p-5 bg-dark text-white">
            <div class="row">
                <div class="col-md-6">
                    <a 
                        href="<?= get_theme_mod( 'pf_resume' ) ?>" 
                        class="btn btn-outline-light text-capitalize"
                    >
                        <i class="fas fa-cloud"></i>
                        download resume
                    </a>
                </div>
            </div>
        </footer>
    </div>

<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalBody"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>    
<?php wp_footer() ?>
</body>
</html>