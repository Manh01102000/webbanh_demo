const TOP = document.querySelector(".top")
window.addEventListener("scroll",function(){
	const x = this.pageYOffset;
	if(x>80){
		TOP.classList.add("active")
	}else{
		TOP.classList.remove("active")
	}
})
// --------------------------js cho chức năng bình luận và chi tiết-------------------------------------------
const chitiet = document.querySelector(".chitiet")
const comment = document.querySelector(".comment")
const button = document.querySelector(".product-content-right-bottom-top")
if(chitiet){
	chitiet.addEventListener("click",function(){
		
		document.querySelector(".product-content-right-bottom-content-comment").style.display = "none"
		document.querySelector(".product-content-right-bottom-content-chitiet").style.display = "block"
	})
}
if(comment){
	comment.addEventListener("click",function(){
		
		document.querySelector(".product-content-right-bottom-content-comment").style.display = "block"
		document.querySelector(".product-content-right-bottom-content-chitiet").style.display = "none"
	})
}
if (button) {
	button.addEventListener("click",function(){
		document.querySelector(".product-content-right-bottom-content-big").classList.toggle("activeB")
	})
}
// ---------------------------------------------hiển thị nội dung khi hover vào----------------------------------------------
