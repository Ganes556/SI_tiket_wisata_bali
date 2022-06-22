function clickBeliTiket(nama, harga,id) {
  $('#titleModalLabel').text(nama);
  // console.log($(this).data('Harga'));
  let formating = (($('#tiket').val() * harga) / 1000).toFixed(3);
  $('#total-pembelian').text("Rp. " + formating)
  $('#total-pembelian').attr('data-harga', harga)
  $('#IdWisata').val(id)
  // console.log(parseInt(formating)*1000)

}

$(document).ready(function () {
  // check input tiket
  jQuery(function ($) {
      $('#tiket').on('input', function () {
          // formating to idr
          let formating = ($(this).val() * $('#total-pembelian').data('harga') / 1000).toFixed(3)
          // set total pembelian
          $("#total-pembelian").text("Rp. " + formating);
      });
      // handle search real time
      $('#search').on('input', function () {
          let search = $('#search').val();
          $.ajax({
              url: 'http://localhost/project_UAS/index.php',
              type: 'GET',
              data: {
                  search: search
              },
              success: function (response) {
                  if (response) {
                      // extract response 
                      // console.log(response)
                      let wisata = JSON.parse(response);
                      let statusLogin = response[0];
                      let card = ``;

                      for (let i = 1; i < wisata.length; i++) {
                          let onclickBtn = (!statusLogin) 
                              ? `onclick="location.href='http://localhost/project_UAS/login.php'"` 
                              : `onclick="clickBeliTiket(\`${wisata[i]['Nama']}\`,${wisata[i]['Harga']},${wisata[i]['IdWisata']})"`;
                              
                          card += `<div class="col">
                                      <div class="card shadow border-0 mb-4" style="width: 18rem;">
                                      <img src="${wisata[i]['UrlThumbnailWST']}" height="150px" class="card-img-top" alt="...">
                                      <div class="card-body">
                                          <div class="card-title d-flex flex-column">
                                              <div class="fw-bold fs-5">${wisata[i]['Nama']}</div>
                                              <div class="fw-bold fs-5 text-warning">
                                                  Rp. ${(wisata[i]['Harga']/1000).toFixed(3)}/Tiket
                                              </div>
                                          </div>
                                          <p class="card-text fw-light truncate-text">${wisata[i]['Deskripsi']}</p>
                                          <div class="">
                                              <a href="http://localhost/project_UAS/detailWisata.php?id=${wisata[i]['IdWisata']}"  class="btn btn-custom px-4 text-warning fw-bold text-uppercase">Detail</a>

                                              <button id="beli-tiket" type="button" ${onclickBtn}

                                                                                      class="btn ms-3 btn-warning text-white fw-bold text-uppercase" data-bs-toggle="modal" data-bs-target="#modalTicket">Beli Tiket</button>
                                          </div>
                                      </div>
                                      </div>
                                  </div>`
                      }   
                      $("#container-wisata").html(card);
                  } else {
                      console.log(0)
                  }                    
              }
          });
      });


  });
  
})
function dismissBeliTiket(){
    // wait biar tidak kelihatan ngeganti
    setTimeout(() => {
        $('#tiket').val(1);
    }, 200);
}

$('#show-password').click(function() {
    let $pwd = $('#password');
    if ($pwd.attr('type') === 'password') {
        $(this).toggleClass('d-none')
        $("#hide-password").toggleClass('d-none');
        $pwd.attr('type', 'text');
    }    
});
$('#hide-password').click(function() {
    let $pwd = $('#password');
    if ($pwd.attr('type') === 'text') {
        $(this).toggleClass('d-none')
        $("#show-password").toggleClass('d-none');
        $pwd.attr('type', 'password');
    }    
});