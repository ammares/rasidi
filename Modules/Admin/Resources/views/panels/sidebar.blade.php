@php
$configData = App\Helpers\Helper::applClasses();
@endphp
<div
  class="main-menu menu-fixed {{(($configData['theme'] === 'dark') || ($configData['theme'] === 'semi-dark')) ? 'menu-dark' : 'menu-light'}} menu-accordion menu-shadow"
  data-scroll-to-active="true">
  <div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
      <li class="nav-item mr-auto">
        <a class="navbar-brand" href="{{url('/')}}">
          <span class="brand-logo">
            <img src="{{asset('storage/logo/logo.png')}}" </span> 
            <h2 class="brand-text p-0">
            <!-- <svg id="logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="180"
              height="40" viewBox="0 0 233.2 39.7">
              <defs>
                <radialGradient id="radial-gradient" cx="0.501" cy="0.5" r="0.5" gradientTransform="translate(0)"
                  gradientUnits="objectBoundingBox">
                  <stop offset="0.005" stop-color="#f3ba32" stop-opacity="0.2" />
                  <stop offset="1" stop-color="#f3ba32" stop-opacity="0" />
                </radialGradient>
                <radialGradient id="radial-gradient-2" cx="0.635" cy="0.455" r="0.35"
                  gradientTransform="matrix(1, 0, 0, 1, 0, 0)" xlink:href="#radial-gradient" />
                <radialGradient id="radial-gradient-3" cx="0.498" cy="0.493" r="0.508"
                  gradientTransform="translate(0.02) scale(0.96 1)" gradientUnits="objectBoundingBox">
                  <stop offset="0.005" stop-color="#f3ba32" stop-opacity="0.2" />
                  <stop offset="0.866" stop-color="#f3ba32" stop-opacity="0.027" />
                  <stop offset="1" stop-color="#f3ba32" stop-opacity="0" />
                </radialGradient>
                <radialGradient id="radial-gradient-4" cx="0.503" cy="0.531" r="0.49"
                  gradientTransform="matrix(0.282, 0.963, -1.01, 0.269, 6.28, 0.439)" xlink:href="#radial-gradient-3" />
                <radialGradient id="radial-gradient-5" cx="0.526" cy="0.637" r="0.343"
                  gradientTransform="translate(7.493 1.098) rotate(97.799)" gradientUnits="objectBoundingBox">
                  <stop offset="0.005" stop-color="#f3ba32" stop-opacity="0.102" />
                  <stop offset="1" stop-color="#f3ba32" stop-opacity="0" />
                </radialGradient>
                <radialGradient id="radial-gradient-6" cx="0.393" cy="0.405" r="0.349"
                  gradientTransform="matrix(-0.497, -0.869, 0.873, -0.495, 5.513, -0.434)"
                  xlink:href="#radial-gradient" />
              </defs>
              <g id="Group_6658" data-name="Group 6658">
                <circle id="Ellipse_333" data-name="Ellipse 333" cx="14" cy="14" r="14" transform="translate(20.6)"
                  fill="url(#radial-gradient)" />
                <path id="Path_51739" data-name="Path 51739"
                  d="M41.7,22.4l-4.5-2-1.1,4.8-2.9-3.9-3.3,3.6L29.3,20l-4.7,1.4,2-4.5-4.8-1.1,3.9-2.9L22.2,9.6,27,9,25.6,4.3l4.5,2,1.1-4.8,2.9,3.9,3.4-3.5L38,6.7l4.7-1.4-2,4.5,4.8,1.1-3.9,2.9,3.5,3.4-4.8.5Z"
                  fill="url(#radial-gradient-2)" />
                <path id="Path_51740" data-name="Path 51740"
                  d="M23.2,16.7c.2-1.2.9-2.1.9-3.4,0-.9-.7-1.6-.7-2.5-.1-1.3.1-2.8,1.5-3.4.2-.1.5-.1.7-.2a7.851,7.851,0,0,0,3.1-1.4,6.42,6.42,0,0,1,1.3-1c.5-.2.8.1,1.3.2A2.982,2.982,0,0,0,33,4.2a2.55,2.55,0,0,1,3,0,2.7,2.7,0,0,1,.7.8,3.415,3.415,0,0,0,2.4.7,22.6,22.6,0,0,1,2.6-.1,2.4,2.4,0,0,1,2.1,1.3c.4,1-.2,2-.2,3.1a.9.9,0,0,0,.1.5,1.205,1.205,0,0,0,.5.5c.7.5,1.4,1.1,1.4,1.9,0,1.5-2.1,2.2-2.3,3.7,0,.4.1.7.1,1.1a4.445,4.445,0,0,1-.8,3.3,1.205,1.205,0,0,1-.5.5c-.6.3-1.3-.1-1.9,0A3.738,3.738,0,0,0,38,22.7a10.823,10.823,0,0,1-3.6,2.4c-1.4.4-3.1.2-3.9-1a2.276,2.276,0,0,0-.8-.9c-.9-.4-1.9.2-2.7-.6s-.7-2.1-1.5-2.8c-.4-.4-1.1-.5-1.6-.8a2.326,2.326,0,0,1-.7-2.3Z"
                  fill="url(#radial-gradient-3)" />
                <path id="Path_51741" data-name="Path 51741"
                  d="M29.1,4.2c1.2-.1,2.3.3,3.5,0,.9-.2,1.4-1.1,2.2-1.4,1.2-.4,2.8-.6,3.7.5a1.612,1.612,0,0,1,.4.7A8.9,8.9,0,0,0,41,6.6a7.1,7.1,0,0,1,1.4,1c.4.4.1.8.2,1.3.1.6.7,1,1.2,1.4a2.72,2.72,0,0,1,.9,2.9l-.6.9a3.107,3.107,0,0,0,0,2.5,10.434,10.434,0,0,1,.8,2.5,2.6,2.6,0,0,1-.7,2.4c-.8.6-2,.4-3,.6a.52.52,0,0,0-.4.2c-.2.1-.3.4-.4.6a2.911,2.911,0,0,1-1.5,1.9c-1.4.4-2.7-1.5-4.2-1.2a10.375,10.375,0,0,0-1,.4,4.456,4.456,0,0,1-3.4.1c-.2-.1-.5-.2-.6-.4-.5-.5-.3-1.2-.5-1.9-.2-.8-1-1.3-1.7-1.8a9.676,9.676,0,0,1-3.2-2.8,3.618,3.618,0,0,1-.1-4.1c.2-.3.6-.6.6-1,.2-1-.7-1.8-.1-2.8.5-1,1.8-1.2,2.3-2.2a12.765,12.765,0,0,1,.2-1.7,2.182,2.182,0,0,1,1.9-1.2Z"
                  fill="url(#radial-gradient-4)" />
                <g id="Group_6657" data-name="Group 6657">
                  <path id="Path_51742" data-name="Path 51742"
                    d="M24.3,21.3l2.5-4.1-4.6-1.8,4.3-2.3L23.4,9.3l4.9.1-.7-4.9,4.1,2.6,1.8-4.6,2.3,4.3,3.8-3.1-.1,4.9,4.9-.8L41.8,12l4.6,1.8-4.3,2.3,3.1,3.8-4.9-.1.8,4.8-4.2-2.5-1.8,4.6-2.3-4.3L29,25.5l.1-4.9Z"
                    fill="url(#radial-gradient-5)" />
                  <path id="Path_51743" data-name="Path 51743"
                    d="M39,3.1,39.5,8l4.7-1.4-2,4.5L47,12.2l-4,2.9,3.6,3.4-4.9.5,1.4,4.7-4.4-2-1.2,4.8-2.9-4-3.3,3.6-.6-4.9L26,22.6l2-4.5L23.3,17l3.9-2.9-3.5-3.4,4.8-.5L27.1,5.5l4.5,2,1.1-4.8,2.9,4Z"
                    fill="url(#radial-gradient-6)" />
                </g>
                <circle id="Ellipse_334" data-name="Ellipse 334" cx="3.2" cy="3.2" r="3.2"
                  transform="translate(30.6 11.1)" fill="#fff" />
              </g>
              <g id="Group_6659" data-name="Group 6659">
                <path id="Path_51744" data-name="Path 51744"
                  d="M0,6.4H2.6V18.3h.1a8.181,8.181,0,0,1,2.5-2,6.428,6.428,0,0,1,3.1-.7,9.737,9.737,0,0,1,3.4.6A7.582,7.582,0,0,1,16,20.5a9.375,9.375,0,0,1,0,6.6,7.821,7.821,0,0,1-1.7,2.6,7.386,7.386,0,0,1-2.5,1.7,8.149,8.149,0,0,1-3.1.6A7.244,7.244,0,0,1,5,31.1a5.648,5.648,0,0,1-2.3-2.3H2.6v2.8H0ZM2.6,23.8A5.867,5.867,0,0,0,3,26.1a5.444,5.444,0,0,0,1.1,1.8,5.675,5.675,0,0,0,1.8,1.2,5.555,5.555,0,0,0,2.3.5,5.932,5.932,0,0,0,2.3-.5,5.675,5.675,0,0,0,1.8-1.2,4.185,4.185,0,0,0,1.1-1.8,5.867,5.867,0,0,0,.4-2.3,5.867,5.867,0,0,0-.4-2.3,5.444,5.444,0,0,0-1.1-1.8,5.675,5.675,0,0,0-1.8-1.2A4.709,4.709,0,0,0,8.1,18a5.932,5.932,0,0,0-2.3.5A5.675,5.675,0,0,0,4,19.7a4.185,4.185,0,0,0-1.1,1.8A8.524,8.524,0,0,0,2.6,23.8Z"
                  fill="#4c4a4b" />
                <path id="Path_51745" data-name="Path 51745"
                  d="M20.5,19.7a12.75,12.75,0,0,0-.1-2c0-.6-.1-1.2-.1-1.7h2.5v2.6H23a3.827,3.827,0,0,1,.8-1.1,4,4,0,0,1,1.2-1,5.226,5.226,0,0,1,1.5-.7,5.663,5.663,0,0,1,1.8-.3h.5a4.331,4.331,0,0,1,.5.1l-.2,2.6a5.9,5.9,0,0,0-1.4-.2,3.834,3.834,0,0,0-3.5,1.6,7.583,7.583,0,0,0-1.1,4.3v7.6H20.5V19.7Z"
                  fill="#4c4a4b" />
                <path id="Path_51746" data-name="Path 51746" d="M32.5,16h2.6V31.6H32.5Z" fill="#4c4a4b" />
                <path id="Path_51747" data-name="Path 51747"
                  d="M55.9,30.9c0,2.8-.7,5-2.2,6.5a8.494,8.494,0,0,1-6.3,2.2,11.582,11.582,0,0,1-4.2-.7,9.231,9.231,0,0,1-3.5-2.3l1.9-2.1a7.909,7.909,0,0,0,2.6,2,6.565,6.565,0,0,0,3.2.7,7.948,7.948,0,0,0,2.9-.5,3.677,3.677,0,0,0,1.8-1.4,5.155,5.155,0,0,0,.9-2,9.282,9.282,0,0,0,.3-2.4v-2h-.1a5.65,5.65,0,0,1-2.4,2.2,6.7,6.7,0,0,1-3.1.7,9.737,9.737,0,0,1-3.4-.6,7.821,7.821,0,0,1-2.6-1.7A7.386,7.386,0,0,1,40,27a8.291,8.291,0,0,1-.6-3.2,8.97,8.97,0,0,1,.6-3.4,7.821,7.821,0,0,1,1.7-2.6,7.6,7.6,0,0,1,2.6-1.6,9.342,9.342,0,0,1,3.4-.6,8.752,8.752,0,0,1,1.6.2,5.228,5.228,0,0,1,1.6.6,7.1,7.1,0,0,1,1.4,1,5.019,5.019,0,0,1,1,1.4h.1V16H56V30.9ZM42.2,23.8a5.381,5.381,0,0,0,.4,2.2,5.515,5.515,0,0,0,3,3,5.222,5.222,0,0,0,2.1.4,6.042,6.042,0,0,0,2.4-.5,4.628,4.628,0,0,0,1.8-1.3A5.444,5.444,0,0,0,53,25.8a7.8,7.8,0,0,0,.4-2.2,5.867,5.867,0,0,0-.4-2.3,5.444,5.444,0,0,0-1.1-1.8,5.675,5.675,0,0,0-1.8-1.2,6.107,6.107,0,0,0-4.6.1,4.345,4.345,0,0,0-1.7,1.2,4.185,4.185,0,0,0-1.1,1.8A5.186,5.186,0,0,0,42.2,23.8Z"
                  fill="#4c4a4b" />
                <path id="Path_51748" data-name="Path 51748"
                  d="M60.7,6.4h2.6V18.2h.1a5.5,5.5,0,0,1,.7-.9,4.44,4.44,0,0,1,1.1-.8,11.64,11.64,0,0,1,1.5-.6,4.678,4.678,0,0,1,1.7-.2,7.635,7.635,0,0,1,2.7.5A4.968,4.968,0,0,1,73,17.5a4.9,4.9,0,0,1,1.1,2,10.871,10.871,0,0,1,.4,2.6v9.6H71.9V22.3a4.964,4.964,0,0,0-.9-3.1,3.1,3.1,0,0,0-2.7-1.1,5.087,5.087,0,0,0-2.2.4,4.428,4.428,0,0,0-1.5,1.2,5.575,5.575,0,0,0-.9,1.9,8.751,8.751,0,0,0-.3,2.4v7.6H60.8V6.4Z"
                  fill="#4c4a4b" />
                <path id="Path_51749" data-name="Path 51749"
                  d="M87.8,18.2H83.2v9.2a2.016,2.016,0,0,0,.3,1.1,2.7,2.7,0,0,0,.7.8,2.5,2.5,0,0,0,1.3.3,4.869,4.869,0,0,0,1.2-.1,3.582,3.582,0,0,0,1.1-.4l.1,2.4a5.415,5.415,0,0,1-1.5.4,8.6,8.6,0,0,1-1.6.1,4.556,4.556,0,0,1-2.2-.4,2.683,2.683,0,0,1-1.3-1,3.78,3.78,0,0,1-.6-1.7,15.483,15.483,0,0,1-.1-2.2V18.1H77.2V16h3.4V11.6h2.6V16h4.6Z"
                  fill="#4c4a4b" />
                <path id="Path_51750" data-name="Path 51750"
                  d="M104.9,28.8a7.989,7.989,0,0,1-3.1,2.5,9.374,9.374,0,0,1-3.9.7,7.246,7.246,0,0,1-3.3-.7,6.422,6.422,0,0,1-2.5-1.8A7.552,7.552,0,0,1,90.6,27a8.662,8.662,0,0,1-.6-3.2,8.808,8.808,0,0,1,.6-3.3,7.821,7.821,0,0,1,1.7-2.6,8.518,8.518,0,0,1,2.5-1.7,8.291,8.291,0,0,1,3.2-.6,7.306,7.306,0,0,1,3,.6,7.759,7.759,0,0,1,2.4,1.6,6.142,6.142,0,0,1,1.5,2.6,9.562,9.562,0,0,1,.5,3.5v.8H92.9a4.136,4.136,0,0,0,.5,1.9,5.715,5.715,0,0,0,1.1,1.6,4.569,4.569,0,0,0,1.6,1.1,4.477,4.477,0,0,0,2,.4,6.527,6.527,0,0,0,2.9-.6,5.954,5.954,0,0,0,2.1-1.8Zm-2.2-6.4a4.448,4.448,0,0,0-1.3-3.2A4.7,4.7,0,0,0,98,18a4.8,4.8,0,0,0-5.1,4.4Z"
                  fill="#4c4a4b" />
                <path id="Path_51751" data-name="Path 51751"
                  d="M109.5,19.7a12.75,12.75,0,0,0-.1-2c0-.6-.1-1.2-.1-1.7h2.5v2.6h.1a3.827,3.827,0,0,1,.8-1.1,4,4,0,0,1,1.2-1,5.226,5.226,0,0,1,1.5-.7,5.663,5.663,0,0,1,1.8-.3h.5a4.331,4.331,0,0,1,.5.1l-.2,2.6a5.9,5.9,0,0,0-1.4-.2,3.834,3.834,0,0,0-3.5,1.6,7.583,7.583,0,0,0-1.1,4.3v7.6h-2.6V19.7Z"
                  fill="#4c4a4b" />
                <path id="Path_51752" data-name="Path 51752"
                  d="M120.4,27.8a1.816,1.816,0,0,1,1.4.6,1.974,1.974,0,0,1,.6,1.4,1.816,1.816,0,0,1-.6,1.4,2,2,0,0,1-3.4-1.4,2.051,2.051,0,0,1,2-2Z"
                  fill="#4c4a4b" />
                <path id="Path_51753" data-name="Path 51753"
                  d="M130.5,25a4,4,0,0,0,1.4,2.8,4.271,4.271,0,0,0,2.9,1,4.871,4.871,0,0,0,2.5-.6,5.48,5.48,0,0,0,1.8-1.6l2.9,2.2a7.989,7.989,0,0,1-3.1,2.5,9.223,9.223,0,0,1-3.6.7,9.737,9.737,0,0,1-3.4-.6,8.751,8.751,0,0,1-2.8-1.7,7.72,7.72,0,0,1-1.9-2.7,7.824,7.824,0,0,1-.7-3.5,8.116,8.116,0,0,1,.7-3.5,10.148,10.148,0,0,1,1.9-2.7,7.28,7.28,0,0,1,2.8-1.7,9.737,9.737,0,0,1,3.4-.6,8.149,8.149,0,0,1,3.1.6,8.068,8.068,0,0,1,2.4,1.7,5.94,5.94,0,0,1,1.5,2.7,10.636,10.636,0,0,1,.6,3.7V25Zm8.2-3a3.763,3.763,0,0,0-1.1-2.8,4.04,4.04,0,0,0-3-1,3.945,3.945,0,0,0-2.9,1,4.892,4.892,0,0,0-1.3,2.8Z"
                  fill="#ed9f43" />
                <path id="Path_51754" data-name="Path 51754"
                  d="M146.5,15.6h3.8v2.6h.1a6.845,6.845,0,0,1,1.7-2.1,5.075,5.075,0,0,1,3.2-.9,6.845,6.845,0,0,1,2.7.5,5.125,5.125,0,0,1,1.8,1.4,4.725,4.725,0,0,1,1,2,9.283,9.283,0,0,1,.3,2.4V31.6h-4V23.5A8.635,8.635,0,0,0,157,22a3.707,3.707,0,0,0-.4-1.5,3.449,3.449,0,0,0-.9-1.2,2.544,2.544,0,0,0-1.6-.5,4.31,4.31,0,0,0-1.7.3,2.445,2.445,0,0,0-1.1.9,5.387,5.387,0,0,0-.7,1.3,7.719,7.719,0,0,0-.2,1.5v8.7h-4V15.6Z"
                  fill="#ed9f43" />
                <path id="Path_51755" data-name="Path 51755"
                  d="M168.8,25a4,4,0,0,0,1.4,2.8,4.271,4.271,0,0,0,2.9,1,4.871,4.871,0,0,0,2.5-.6,5.48,5.48,0,0,0,1.8-1.6l2.9,2.2a7.989,7.989,0,0,1-3.1,2.5,9.223,9.223,0,0,1-3.6.7,9.737,9.737,0,0,1-3.4-.6,8.751,8.751,0,0,1-2.8-1.7,7.72,7.72,0,0,1-1.9-2.7,7.824,7.824,0,0,1-.7-3.5,8.116,8.116,0,0,1,.7-3.5,10.148,10.148,0,0,1,1.9-2.7,8.751,8.751,0,0,1,2.8-1.7,9.737,9.737,0,0,1,3.4-.6,8.149,8.149,0,0,1,3.1.6,8.068,8.068,0,0,1,2.4,1.7,5.94,5.94,0,0,1,1.5,2.7,10.636,10.636,0,0,1,.6,3.7V25Zm8.2-3a3.763,3.763,0,0,0-1.1-2.8,4.04,4.04,0,0,0-3-1,3.945,3.945,0,0,0-2.9,1,4.892,4.892,0,0,0-1.3,2.8Z"
                  fill="#ed9f43" />
                <path id="Path_51756" data-name="Path 51756"
                  d="M184.8,15.6h4v2.5h.1a5.1,5.1,0,0,1,1.9-2.2,5.376,5.376,0,0,1,2.8-.8,1.7,1.7,0,0,1,.7.1,1.854,1.854,0,0,1,.7.2v3.9a3.553,3.553,0,0,0-1-.2,3.083,3.083,0,0,0-1-.1,5.214,5.214,0,0,0-2.3.5,3.039,3.039,0,0,0-1.3,1.2,3.79,3.79,0,0,0-.6,1.3,5.755,5.755,0,0,0-.2,1v8.6h-4v-16Z"
                  fill="#ed9f43" />
                <path id="Path_51757" data-name="Path 51757"
                  d="M213.6,15.6V30.2a15.376,15.376,0,0,1-.5,3.9,7.364,7.364,0,0,1-1.7,3,8.15,8.15,0,0,1-2.8,1.9,11.917,11.917,0,0,1-4,.7,14.213,14.213,0,0,1-4.2-.6,9.835,9.835,0,0,1-3.7-2.1l2.4-3.3a10.064,10.064,0,0,0,2.5,1.7,7.306,7.306,0,0,0,3,.6,5.464,5.464,0,0,0,2.4-.4,3.807,3.807,0,0,0,1.6-1.1,3.365,3.365,0,0,0,.8-1.7,7.8,7.8,0,0,0,.3-2.2V29.4h-.1a5.167,5.167,0,0,1-2.3,1.8,7.533,7.533,0,0,1-2.9.6,7.246,7.246,0,0,1-3.3-.7,6.422,6.422,0,0,1-2.5-1.8,7.6,7.6,0,0,1-1.6-2.6,8.662,8.662,0,0,1-.6-3.2,11.418,11.418,0,0,1,.5-3.3,9.186,9.186,0,0,1,1.6-2.7,6.422,6.422,0,0,1,2.5-1.8,8.841,8.841,0,0,1,3.3-.7,7.111,7.111,0,0,1,3.2.7,4.71,4.71,0,0,1,2.3,2.1h.1V15.4h3.7Zm-8.5,3.2a3.807,3.807,0,0,0-1.9.4,3.956,3.956,0,0,0-1.5,1,5.6,5.6,0,0,0-1,1.5,5.917,5.917,0,0,0-.4,2,3.922,3.922,0,0,0,.4,1.8,4.924,4.924,0,0,0,1,1.5,3.956,3.956,0,0,0,1.5,1,5.847,5.847,0,0,0,1.9.4,4.477,4.477,0,0,0,2-.4,3.956,3.956,0,0,0,1.5-1,5.6,5.6,0,0,0,1-1.5,5.822,5.822,0,0,0,.3-1.9,4.521,4.521,0,0,0-1.3-3.4A4.325,4.325,0,0,0,205.1,18.8Z"
                  fill="#ed9f43" />
                <path id="Path_51758" data-name="Path 51758"
                  d="M216,15.6h4.4l4.5,11.1h.1l4-11.1h4.2L225.6,35a9.332,9.332,0,0,1-1,2,8.7,8.7,0,0,1-1.2,1.4,4.608,4.608,0,0,1-1.7.9,7.55,7.55,0,0,1-2.3.3,11,11,0,0,1-3.1-.4l.5-3.6c.3.1.6.2,1,.3a3.75,3.75,0,0,0,1.1.1,4.121,4.121,0,0,0,1.2-.1,3.552,3.552,0,0,0,.9-.4,4.35,4.35,0,0,0,.6-.7,11.731,11.731,0,0,0,.5-1.1l.8-1.9Z"
                  fill="#ed9f43" />
              </g>
            </svg> -->
            </h2>
        </a>
      </li>
      <!-- <li class="nav-item nav-toggle">
        <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
          <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
          <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
            data-ticon="disc"></i>
        </a>
      </li> -->
    </ul>
  </div>
  <div class="shadow-bottom"></div>
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      {{-- Foreach menu item starts --}}
      @if(isset($menuData))
      @foreach($menuData->menu as $menu)
      @if(isset($menu->navheader))
      <li class="navigation-header">
        <span>{{ $menu->navheader }}</span>
        <i data-feather="more-horizontal"></i>
      </li>
      @else
      {{-- Add Custom Class with nav-item --}}
      @php
      $custom_classes = "";
      if(isset($menu->classlist)) {
      $custom_classes = $menu->classlist;
      }
      @endphp
      <li class="nav-item {{ Route::currentRouteName() === $menu->slug ? 'active' : '' }} {{ $custom_classes }}">
        <a href="{{isset($menu->url)? url($menu->url):'javascript:void(0)'}}" class="d-flex align-items-center"
          target="{{isset($menu->newTab) ? '_blank':'_self'}}">
          <i data-feather="{{ $menu->icon }}"></i>
          <span class="menu-title text-truncate">{{ __('locale.'.$menu->name) }}</span>
          @if (isset($menu->badge))
          <?php $badgeClasses = "badge badge-pill badge-light-primary ml-auto mr-1" ?>
          <span class="{{ isset($menu->badgeClass) ? $menu->badgeClass : $badgeClasses }} ">{{$menu->badge}}</span>
          @endif
        </a>
        @if(isset($menu->submenu))
        @include('admin::panels/submenu', ['menu' => $menu->submenu])
        @endif
      </li>
      @endif
      @endforeach
      @endif
      {{-- Foreach menu item ends --}}
    </ul>
  </div>
</div>
<!-- END: Main Menu-->