<div class="content-backdrop fade_ d-flex align-items-center">
	<div class="custom-loader m-auto"></div>
</div>

<style type="text/css">
.custom-loader {
  width: 80px;
  height: 80px;
  display: grid;
  border:8px solid #0000;
  border-radius: 50%;
  border-color:#55B3D9 #0000;
  animation: s6 1s infinite linear;
}
.custom-loader::before,
.custom-loader::after {    
  content:"";
  grid-area: 1/1;
  margin:2px;
  border:inherit;
  border-radius: 50%;
}
.custom-loader::before {
  border-color:#3A668C #0000;
  animation:inherit; 
  animation-duration: .8s;
  animation-direction: reverse;
}
.custom-loader::after {
  margin:8px;
}

@keyframes s6 { 
  100%{transform: rotate(1turn)}
}
</style>