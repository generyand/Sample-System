(function () {
  "use strict";
  const navLinks = document.querySelectorAll(".nav-links");
  const crudOps = document.querySelectorAll(".crud");

  function handleClick(event) {
    event.preventDefault();

    navLinks.forEach((link) => {
      link.classList.remove("active");
    });

    for (let i = 0; i < crudOps.length; i++) {
      if (crudOps[i].classList.contains(event.target.id)) {
        crudOps[i].classList.remove("display-none");
      } else {
        crudOps[i].classList.add("display-none");
      }
    }

    event.target.classList.add("active");
  }

  navLinks.forEach((link) => {
    link.addEventListener("click", handleClick);
  });
})();
