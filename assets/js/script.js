// @@@
// pop up add grade
// @@@
let btn_add_grade = document.querySelector(".add-school");
let section_add_grade = document.querySelector(".section_add_grade");

// Fontion qui gere l'affichage du pop up grade
btn_add_grade.addEventListener('click', popup_grade);
section_add_grade.addEventListener('click', popup_grade);


function popup_grade() {
    section_add_grade.classList.toggle("active");
}
