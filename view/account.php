 <!-- Cart view section -->
 <section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="aa-myaccount-area">         
            <div class="row">
              <div class="col-md-6">
                <div class="aa-myaccount-register">                 
                 <h4>Daftar</h4>
                 <form action="account?act=do_add" method=POST class="aa-login-form">
                    <label for="">Nama<span>*</span></label>
                    <input type="text" name=nama placeholder="Nama" required>
					<label for="">Alamat<span>*</span></label>
                    <input type="text" name=alamat placeholder="alamat" required>
					<label for="">Tanggal Lahir<span>*</span></label>
					<input readonly style="background-color:white;color:black;margin-right: -4%;" maxlength="25" type="text" class="form-control datepicker" placeholder="<?php echo date("d/m/Y") ?>" name="tgl_lahir" id="tgl_lahir" required>
					<label for="">Email<span>*</span></label>
                    <input type="text" name=email placeholder="Email" required>
                    <label for="">Password<span>*</span></label>
                    <input type="password" name=password placeholder="Password" required>
                    <button type="submit" class="aa-browse-btn">Daftar</button>                    
                  </form>
                </div>
              </div>
            </div>          
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->
<script type="text/javascript">
	setTimeout(function(){ 
		 $('.datepicker').datepicker({
			format: 'dd/mm/yyyy'
		});
	}, 2000);
</script>