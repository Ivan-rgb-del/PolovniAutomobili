function showSubCategories() {
  document.querySelector(".carSubcategories").classList.add("hidden");
  document.querySelector(".vanSubcategories").classList.add("hidden");
  let category = document.getElementById("categories").value;

  if (category == "1") {
    document.querySelector(".carSubcategories").classList.remove("hidden");
  } else if (category == "2") {
    document.querySelector(".vanSubcategories").classList.remove("hidden");
  }
}