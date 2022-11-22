// @@@
// pop up add grade
// @@@
let btn_add_grade = document.querySelector(".add-grade");
let section_add_grade = document.querySelector(".section_add_grade");
let container_pop_up = document.querySelector(".container_pop_up");

// Fontion qui gere l'affichage du pop up grade
btn_add_grade.addEventListener('click', popup_grade);
section_add_grade.addEventListener('click', popup_grade);


function popup_grade() {
    section_add_grade.classList.toggle("active");
    container_pop_up.classList.toggle("active");
    popUp.style.top = `${posInitiale}px`;
    popUp.removeEventListener('mousedown', slideStart);
  }

// @@@
// slide garde
// @@@
let sections = document.querySelectorAll('.item-shool-level');

let landmarks = document.querySelectorAll('.item-landmark');

// for(let sec = 0; sec < sections.length; sec++){
//   for(let land = 0; land < landmarks.length; land++){
//     if(sections[sec].id == landmarks[land].id){
//       landmarks[land].classList.add('actif');
//     }
//   }
// }

let containerSlides =  document.querySelector('.container-slide');
let slides =  document.querySelectorAll('.item-shool-level');
let slideSize = 400;


let positionClic = 0;
let positionGlissade = 0;
let posInitiale;
let posFinale;
let limitePourDeplacer = 100;

let index;
creatLimitSlide();
let limitSlide = -index * 400;



function creatLimitSlide(){
    index = 0;
    for (let i of slides) {
      index++;
    }
    index = index - 1;
   
    return index;
}

containerSlides.addEventListener('mousedown', dragStart);

function dragStart(e){
  e.preventDefault();

  posInitiale = containerSlides.offsetLeft;
  positionClic = e.clientX;

  document.addEventListener('mousemove', bougerLeContainerASlides);
  document.addEventListener('pointerup', finDuDrag);
}

function bougerLeContainerASlides(e){
  // console.log(`ANCIEN : ${positionClic}NOUVEAU : ${e.clientX}`);
  positionGlissade = positionClic - e.clientX;
  positionClic = e.clientX;

  if(containerSlides.offsetLeft - positionGlissade > 0 || containerSlides.offsetLeft - positionGlissade < limitSlide){
    // console.log("STOP");
    return;
  }

  containerSlides.style.left = `${containerSlides.offsetLeft - positionGlissade}px`;
}

function finDuDrag(){

  posFinale = containerSlides.offsetLeft;

  if(posFinale - posInitiale < -limitePourDeplacer){
    bougerLesSlides(1);
    posInitiale = 0;
  } 
  else if (posFinale - posInitiale > limitePourDeplacer){
    bougerLesSlides(-1);
    posInitiale = 0;
  }
  else {
    containerSlides.style.left = `${posInitiale}px`;
  }


  document.removeEventListener('mousemove', bougerLeContainerASlides);
  document.removeEventListener('pointerup', finDuDrag);
}


function bougerLesSlides(direction){

  containerSlides.classList.add('glissade');

  if(direction === 1){
    containerSlides.style.left = `${posInitiale - slideSize}px`;
  }
  else if (direction === -1){
    containerSlides.style.left = `${posInitiale + slideSize}px`;
  }

}
containerSlides.addEventListener('transitionend', () => {
  containerSlides.classList.remove('glissade');
})

// @@@
// glisser pour cacher le pop up
// @@@

let popUp =  document.querySelector('.pop_up_add_grade');


popUp.onmousedown = function(){
  popUp.addEventListener('mousedown', slideStart);
}
popUp.removeEventListener('mousedown', slideStart);


function slideStart(e){
    e.preventDefault();
  
    posInitiale = popUp.offsetTop;
    positionClic = e.clientY;

    // console.log(posInitiale);
    
    document.addEventListener('mousemove', movePopup);
    document.addEventListener('pointerup', endMovePopUp);
}

function movePopup(e){
    // console.log(`ANCIEN : ${positionClic}NOUVEAU : ${e.clientY}`);

    positionGlissade = positionClic - e.clientY;
    positionClic = e.clientY;

    if(popUp.offsetTop - positionGlissade < 0){
    // console.log("STOP");
    return;
    }

    popUp.style.top = `${popUp.offsetTop - positionGlissade}px`;
}

function endMovePopUp(){
    posFinale = popUp.offsetTop;

    if(posFinale - posInitiale > limitePourDeplacer){
        move(1);
    } 
    else {
        popUp.style.top = `${posInitiale}px`;
    }

    document.removeEventListener('mousemove', movePopup);
    document.removeEventListener('pointerup', endMovePopUp);
}

function move(move){
    
    if(move === 1){
      section_add_grade.classList.remove("active");
      container_pop_up.classList.remove("active");
    }
}

// ----------------------------------------------------------
// @@@
// link nav actif
// @@@

// window.addEventListener('scroll', linkActif);

function linkActif(){

  

  var section1Cal = section1.offsetWidth+section1.offsetLeft - 100;
  var section2Cal = section2.offsetWidth+section2.offsetLeft - 100;
  var section3Cal = section3.offsetWidth+section3.offsetLeft - 100;

  let scroolX = window.scrollY;


  if(scroolY < section1Cal){
    link1.classList.add('actif');
  }
  else{
    link1.classList.remove('actif');
  }

  if (scroolY >= section1Cal && scroolY < section2Cal){
    link2.classList.add('actif');
    landmark1.classList.add('defined');
  } 
  else{
    link2.classList.remove('actif');
    landmark1.classList.remove('defined');
  }

  if (scroolY >= section2Cal && scroolY <= section3Cal){
    link3.classList.add('actif');
    landmark2.classList.add('defined');
  } 
  else{
    link3.classList.remove('actif');
    landmark2.classList.remove('defined');
  }

  if (scroolY >= section3Cal && scroolY < section4Cal){
    link4.classList.add('actif');
    landmark3.classList.add('defined');
  } 
  else{
    link4.classList.remove('actif');
    landmark3.classList.remove('defined');
  }

  if (scroolY >= section5Cal){
    link5.classList.add('actif');
    link4.classList.remove('actif');
    landmark4.classList.add('defined');
    landmark3.classList.remove('defined');
  } 
  else{
    link5.classList.remove('actif');
    landmark4.classList.remove('defined');
  }
}