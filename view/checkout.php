  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
    <img src="<?php echo $basepath.'assets/img/4.jpeg' ?> " alt="fashion img" width=100% height=50%>
    <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Checkout Page</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>                   
          <li class="active">Checkout</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->
<div class="container">
	<form name=f1 method=post action='checkout?act=lanjut'  enctype=\"multipart/form-data\">
	<table id="cart" class="table table-hover table-condensed">
    				<thead>
						<tr>
							<th style="width:50%">Produk</th>
							<th style="width:10%">Harga</th>
							<th style="width:8%">Kuantitas</th>
							<th style="width:10%" class="text-center">Subtotal</th>
							<th style="width:10%"></th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$sql = "select a.no_pesanan,a.id_pesanan_detail,a.id_produk,b.* from pesanan_detail a left join produk b on a.id_produk = b.Id_Produk where email='$email' and status='1'";
						$result = $db->execute($sql);
						$no = 1;
						while($rl = $result->FetchRow()){
							foreach($rl as $key=>$val){
								$key=strtolower($key);
								$$key=$val;
							}
							
							echo "<tr>
								<td data-th='Product'>
									<div class='row'>
										<div class='col-sm-2 hidden-xs'><img src='".$basepath."assets/img/produk/$gambar' alt='...' class='img-responsive'/></div>
										<div class='col-sm-10'>
											<h4 class='nomargin'>$nama_produk</h4>
											<p>".substr($keterangan,0,80)."</p>
											<input type='hidden' id=no_pesanan_$no name=no_pesanan_$no value ='$no_pesanan' >
											<input type='hidden' id=id_produk_$no name=id_produk_$no value ='$id_produk' >
										</div>
									</div>
								</td>
								<td data-th='Price'>Rp ".$gen_controller->ribuan($harga)." <input type='hidden' id=harga_$no name=harga_$no value ='$harga' ></td>
								<td data-th='Quantity'>
									<input type='text' id=hitung_$no name=hitung_$no class='form-control text-right' size=2 onblur='hitung_total()' onkeyup=hitung(this.value,$no) onkeypress='return hanyaAngka(event)' maxlength='3' value='1'/>
								</td>
								<td data-th='Subtotal' class='text-center'><span id='test_total_$no' name='test_total_$no'>Rp ".$gen_controller->ribuan($harga)."</span><input type='hidden' id=total_$no name=total_$no value='".$harga."'/> </td>
								<td class='actions' data-th=''>
									<a class='btn btn-danger btn-sm' href='checkout?act=delete&id_parameter=".$id_pesanan_detail."' style='width:100px;margin-bottom:2pt;'> <i class='fa fa-trash-o'></i></a>		
								</td>
							</tr>";
							$no++;
						}
						$count = $db->getOne("select count(1) from pesanan_detail where email='$email' and status='1'");
						echo "<input type='hidden' id=jumlah_pesanan name=jumlah_pesanan value='".$count."'/>";
						$total_keseluruhan = $db->getOne("select sum(b.harga) from pesanan_detail a left join produk b on a.id_produk = b.Id_Produk where email='$email' and status='1'");
						?>
					</tbody>
					<tfoot>
						<tr>
							<td><a href="#" class="btn btn-warning"><i class="fa fa-angle-left"></i>Lanjutkan Memilih</a></td>
							<td colspan="2" class="hidden-xs"><strong>Total</strong></td>
							<td class="hidden-xs text-center"><strong> <span id='total_keseluruhan1' name='total_keseluruhan1'><?php echo "".$gen_controller->ribuan($total_keseluruhan).""; ?> </span> <input type=hidden id=total_keseluruhan name=total_keseluruhan value='<?php echo "".$gen_controller->ribuan($total_keseluruhan).""; ?>'></strong></td>
							<td>
							<input class="btn btn-success btn-block" type=submit value='Pembayaran'></td>
						</tr>
					</tfoot>
				</table>
				</form>
</div>

<script language=Javascript>

function hitung(tot,no){
	var test = document.getElementById('harga_'+no).value;
	var hasil = parseInt(test*tot);
	document.getElementById('test_total_'+no).innerHTML=ribuan(hasil);
	document.getElementById('total_'+no).value=hasil;
	
}

function hitung_total(){
	var jumlah_pesanan = document.getElementById('jumlah_pesanan').value;
	var total_jadi=0;
	for(var a=1; a <= jumlah_pesanan; a++){
		var tot_keseluruhan = document.getElementsByName('total_'+a)[0].value.split('.').join('');
		if(isNaN(tot_keseluruhan) || !tot_keseluruhan || tot_keseluruhan==''){
			var tot_keseluruhan1=0;
		}else{
			var tot_keseluruhan1=tot_keseluruhan;
		}
			total_jadi += parseInt(tot_keseluruhan1);
	}
		var total_keseluruhan = document.getElementById('total_keseluruhan').value=total_jadi;
		var total_keseluruhan1 = document.getElementById('total_keseluruhan1').innerHTML=ribuan(total_jadi);
}

function hanyaAngka(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode
   if (charCode > 31 && (charCode < 48 || charCode > 57))

	return false;
  return true;
}

</script>











