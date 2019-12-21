$(document).ready(function () {

     ucitajBrojPorudzbina();

     function ucitajBrojPorudzbina() {
          let proizvodi = JSON.parse(window.localStorage.getItem('proizvodi'));

          if((proizvodi == null) || (proizvodi['proizvodi'].length == 0))
          {
               $('#cart h5').css('display', 'none');
               $('#navCart').css('display', 'none');
          }
          else
          {
               var tekst = "<i class='fa fa-shopping-cart'>" + proizvodi['proizvodi'].length + "</i>";
               $('#cart h5').css('display', 'inline');
               $('#cart h5').text(proizvodi['proizvodi'].length);
               $('#navCart').css('color', 'red');
               $('#navCart').css('display', 'inline');
               $('#navCart').html(tekst);
          }
     }

     function registracijaToggle() {
          var registracija = document.getElementById("registracija");
          var prijava = document.getElementById("prijava");
          prijava.style.display = "none";
          registracija.style.display = "block";
     }

     function prijavaToggle() {
          var registracija = document.getElementById("registracija");
          var prijava = document.getElementById("prijava");
          prijava.style.display = "block";
          registracija.style.display = "none";
     }



     $(".mainflip").hover(function () {
          // $(this).css("background-color", "yellow");
          // console.log("asasdasd");
          var text = $(this).find(".backside").find(".card-text");
          if (text.text().length > 500) {
               var newText = text.text().substring(0, 499) + "...";
               text.text(newText);
          }
     }
     );


     function promena() {
          if (document.getElementsByClassName("korpa-proizvoda")[0] != undefined) {
               var proizvodi = document.getElementsByClassName("red");
               var ukupno = 0;
               let lokalProizvodi = JSON.parse(window.localStorage.getItem('proizvodi'));
               // console.log(proizvodi);
               for (proizvod of proizvodi) {
                    // console.log(proizvod);
                    var cena = proizvod.getElementsByClassName("cena")[0];
                    var kolicina = proizvod.getElementsByClassName("kolicina")[0];
                    var suma = proizvod.getElementsByClassName("suma")[0];
                    var proizvodId = proizvod.getElementsByClassName('ukloni-proizvod')[0].getAttribute('data-indeks');
                    // console.log(cena.textContent);
                    var zbir = parseFloat(cena.textContent) * parseFloat(kolicina.value);
                    suma.textContent = zbir;

                    for (let i = 0; i < lokalProizvodi['proizvodi'].length; i++) {
                         if (lokalProizvodi['proizvodi'][i]['id'] == proizvodId) {
                              lokalProizvodi['proizvodi'][i]['kolicina'] = kolicina.value;
                              // lokalProizvodi['proizvodi'][i]['cena'] = zbir;
                              // console.log(lokalProizvodi['proizvodi'][i]);
                         }
                    }
                    ukupno += zbir;
               }

               localStorage.setItem('proizvodi', JSON.stringify(lokalProizvodi));
               document.getElementsByClassName("total")[0].textContent = ukupno;
          }
     }

     // $(".kolicina").change(function () {
     //      promena();
     // })

     $('#korpa-proizvoda').on('change', '.kolicina', promena);

     $('#korpa-proizvoda').on('click', '.ukloni-proizvod', function () {
          let niz = [];
          let proizvodi = JSON.parse(window.localStorage.getItem('proizvodi'));
          for (let i = 0; i < proizvodi['proizvodi'].length; i++) {
               // console.log(proizvodi['proizvodi'][i]['id']);
               if ($(this).attr('data-indeks') != proizvodi['proizvodi'][i]['id']) {
                    niz.push(proizvodi['proizvodi'][i]);
                    // console.log("DODAJ");
               }
          }
          proizvodi['proizvodi'] = niz;
          // console.log(proizvodi);

          $('#cart h5').text(parseInt($('#cart h5').text()) - 1);
          $(this).parent().parent().remove();
          window.localStorage.setItem('proizvodi', JSON.stringify(proizvodi));
          ucitajBrojPorudzbina();
          promena();
     });

     $('#prijava-registracija').on('click', '.closes', function () {
          document.getElementById('prijava-registracija').style.display = 'none';
     });

     $('.dodaj-u-korpu').click(function () {
          let proizvod = {};
          let proizvodIme = $(this).parent().parent().find('.card-title')[0].innerText;
          let proizvodId = $(this).attr('data-indeks');
          let proizvodCena = parseFloat(($(this).parent().find('.price > h5')[0].innerText).match(/[\d\.]+/));
          let proizvodKolicina = $(this).parent().parent().find('.options > .quantity > input')[0].value;
          let proizvodSlika = $(this).parent().parent().parent().find('.wrapper-slika > img').attr('src');
          proizvod['ime'] = proizvodIme;
          proizvod['id'] = proizvodId;
          proizvod['cena'] = proizvodCena;
          proizvod['kolicina'] = proizvodKolicina;
          proizvod['slika'] = proizvodSlika;
          dodajProizvod(proizvod);
     });

     $('.dodaj-iz-proizvoda').click(function () {
          let proizvod = {};
          let proizvodId = $(this).attr('data-indeks');
          let proizvodIme = $(this).parent().parent().find('.naziv-proizvoda')[0].innerText;
          let proizvodCena = parseFloat(($(this).parent().parent().find('.price h5')[0].innerText).match(/[\d\.]+/));
          let proizvodKolicina = $(this).parent().parent().find('.options > .quantity > input')[0].value;
          let proizvodSlika = $(this).parent().parent().parent().find('.swiper-zoom-container > img').attr('src');

          proizvod['ime'] = proizvodIme;
          proizvod['id'] = proizvodId;
          proizvod['cena'] = proizvodCena;
          proizvod['kolicina'] = proizvodKolicina;
          proizvod['slika'] = proizvodSlika;

          // console.log(proizvod);
          dodajProizvod(proizvod);
     });

     function dodajPostojeci(proizvod) {
          let dodat = false;
          let proizvodi = JSON.parse(window.localStorage.getItem('proizvodi'));
          for (let i = 0; i < proizvodi['proizvodi'].length; i++) {
               // console.log(proizvodi['proizvodi'][i]['id']);
               if (proizvod['id'] == proizvodi['proizvodi'][i]['id']) {
                    let tmp = parseInt(proizvodi['proizvodi'][i]['kolicina']);
                    proizvodi['proizvodi'][i]['kolicina'] = tmp + parseInt(proizvod['kolicina']);
                    // console.log("DODAJ");
                    dodat = true;
                    window.localStorage.setItem('proizvodi', JSON.stringify(proizvodi));
               }
          }
          
          return dodat;
     }

     function dodajProizvod(proizvod) {
          let proizvodi = {};
          if (window.localStorage.getItem('proizvodi') == undefined) {
               let niz = [];
               niz.push(proizvod);
               $('#cart > h5').innerHtml = '1';
               proizvodi['proizvodi'] = niz;
               window.localStorage.setItem('proizvodi', JSON.stringify(proizvodi));
               ucitajBrojPorudzbina();
          } else {
               if (dodajPostojeci(proizvod) == false) {
                    // console.log($('#cart h5'));
                    $('#cart h5').text(parseInt($('#cart h5').text()) + 1);
                    proizvodi = JSON.parse(window.localStorage.getItem('proizvodi'));

                    proizvodi['proizvodi'].push(proizvod);
                    // console.log(proizvodi['proizvodi']);
                    window.localStorage.setItem('proizvodi', JSON.stringify(proizvodi));
                    ucitajBrojPorudzbina();
               }
          }
     }

     function osveziKorpu() {
          let proizvodi = JSON.parse(window.localStorage.getItem('proizvodi'));
          proizvodi['proizvodi'].forEach(key => {
               // console.log(key['ime']);
               let proizvod = "<tr class='red'><td data-th='Proizvod'><div class='row'><div class='col-sm-3 hidden-xs'><div class='wrapper-slika'><img class='card-img' src='" + key.slika + "'></div></div><div class='col-sm-9'><h4 class=''>" + key.ime + "</h4></div></div></td><td data-th='Cena' class='cena'>" + key.cena + " rsd.</td><td data-th='Količina'><div class='quantity'><input style='width:100%;padding-right:50%;' type='number' class='kolicina form-control text-center' value='" + parseInt(key.kolicina) + "'></div></td><td data-th='Suma' class='text-center suma'> " + key.cena * key.kolicina + "</td><td class='actions' data-th=''><button data-indeks='" + key.id + "' class='ukloni-proizvod btn btn-danger btn-sm'><i class='fa fa-trash-o'></i></button></td></tr>";

               $('#korpa > tbody').append(proizvod);
          })
     }

     if (document.getElementById('korpa-proizvoda') != undefined) {
          // console.log("ASDASDAS");
          osveziKorpu();
          promena();
     }

     function novostiPrikaz() {
          $.fn.visible = function (partial) {

               var $t = $(this),
                    $w = $(window),
                    viewTop = $w.scrollTop(),
                    viewBottom = viewTop + $w.height(),
                    _top = $t.offset().top,
                    _bottom = _top + $t.height(),
                    compareTop = partial === true ? _bottom : _top,
                    compareBottom = partial === true ? _top : _bottom;

               return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

          };
          var win = $(window);

          var allMods = $(".novost");

          allMods.each(function (i, el) {
               var el = $(el);
               alert('asda');
               if (el.visible(true)) {
                    el.addClass("already-visible");
               }
          });

          win.scroll(function (event) {

               allMods.each(function (i, el) {
                    var el = $(el);
                    if (el.visible(true)) {
                         el.addClass("come-in");
                    }
               });

          });
     }

     jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
     jQuery('.quantity').each(function () {
          var spinner = jQuery(this),
               input = spinner.find('input[type="number"]'),
               btnUp = spinner.find('.quantity-up'),
               btnDown = spinner.find('.quantity-down'),
               min = input.attr('min'),
               max = input.attr('max');

          btnUp.click(function () {
               var oldValue = parseFloat(input.val());
               if (oldValue >= max) {
                    var newVal = oldValue;
               } else {
                    var newVal = oldValue + 1;
               }
               spinner.find("input").val(newVal);
               spinner.find("input").trigger("change");
          });

          btnDown.click(function () {
               var oldValue = parseFloat(input.val());
               if (oldValue <= min) {
                    var newVal = oldValue;
               } else {
                    var newVal = oldValue - 1;
               }
               spinner.find("input").val(newVal);
               spinner.find("input").trigger("change");
          });

     });

     

     if(document.getElementsByClassName('gallery-top')[0] != undefined)
     {
          var galleryTop = new Swiper('.gallery-top', {
               spaceBetween: 10,
               navigation: {
                 nextEl: '.swiper-button-next',
                 prevEl: '.swiper-button-prev',
               },
        });
        var galleryThumbs = new Swiper('.gallery-thumbs', {
          spaceBetween: 10,
          centeredSlides: true,
          slidesPerView: 'auto',
          touchRatio: 0.2,
          slideToClickedSlide: true,
        });
             galleryTop.controller.control = galleryThumbs;
             galleryThumbs.controller.control = galleryTop;
     }

});

function prijavaRegistracija() {
     document.getElementById('prijava-registracija').style.display = 'block';
     prijavaToggle();
}

function registracijaPrikaz()
{
     document.getElementById('prijava-registracija').style.display = 'block';
     registracijaToggle();
}

function zatvoriRegistraciju() {
     document.getElementById('prijava-registracija').style.display = 'none';
}

function registracijaToggle() {
     var registracija = document.getElementById("registracija");
     var prijava = document.getElementById("prijava");
     prijava.style.display = "none";
     registracija.style.display = "block";
}

function prijavaToggle() {
     var registracija = document.getElementById("registracija");
     var prijava = document.getElementById("prijava");
     prijava.style.display = "block";
     registracija.style.display = "none";
}