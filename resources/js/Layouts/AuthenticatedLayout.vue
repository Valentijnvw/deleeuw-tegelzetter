<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link, usePage } from '@inertiajs/inertia-vue3';

const navItems = [
  {
    name: "Dashboard",
    routeName: 'dashboard',
    icon: "bi-house-door"
  },
  {
    name: "Gebruikers",
    routeName: 'user.list',
    icon: "bi-house-door"
  },
  {
    name: "Opdrachten",
    routeName: "opdrachten.list",
    icon: "bi-house-door",
  },
]
const showingNavigationDropdown = ref(false);


(function () {
// STYLE SWITCHER
// =======================================================
const $dropdownBtn = document.getElementById('selectThemeDropdown') // Dropdowon trigger
const $variants = document.querySelectorAll(`[aria-labelledby="selectThemeDropdown"] [data-icon]`) // All items of the dropdown

// Function to set active style in the dorpdown menu and set icon for dropdown trigger
const setActiveStyle = function () {
    $variants.forEach($item => {
    if ($item.getAttribute('data-value') === HSThemeAppearance.getOriginalAppearance()) {
        $dropdownBtn.innerHTML = `<i class="${$item.getAttribute('data-icon')}" />`
        return $item.classList.add('active')
    }

    $item.classList.remove('active')
    })
}

// Add a click event to all items of the dropdown to set the style
$variants.forEach(function ($item) {
    $item.addEventListener('click', function () {
    HSThemeAppearance.setAppearance($item.getAttribute('data-value'))
    })
})

// Call the setActiveStyle on load page
setActiveStyle()

// Add event listener on change style to call the setActiveStyle function
window.addEventListener('on-hs-appearance-change', function () {
    setActiveStyle()
})
})()
</script>

<template>
    <header id="header" class="navbar navbar-expand-lg navbar-bordered bg-white  ">
    <div class="container">
      <nav class="js-mega-menu navbar-nav-wrap">
        <!-- Logo -->

        <a class="navbar-brand" href="/" aria-label="Front">
          <img class="navbar-brand-logo" src="../../img/deleeuw/deleeuwtegelzetterbv_V3-300x195.png" alt="Logo" data-hs-theme-appearance="default">
        </a>

        <!-- End Logo -->

        <!-- Secondary Content -->
        <div class="navbar-nav-wrap-secondary-content">
          <!-- Navbar -->
          <ul class="navbar-nav">
            <li class="nav-item d-none d-md-inline-block">
              <!-- Notification -->
              <div class="dropdown">
                <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle" id="navbarNotificationsDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" data-bs-dropdown-animation>
                  <i class="bi-bell"></i>
                  <span class="btn-status btn-sm-status btn-status-danger"></span>
                </button>

                <div class="dropdown-menu dropdown-menu-end dropdown-card navbar-dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="navbarNotificationsDropdown" style="width: 25rem;">
                  <div class="card">
                    <!-- Header -->
                    <div class="card-header card-header-content-between">
                      <h4 class="card-title mb-0">Notifications</h4>

                      <!-- Unfold -->
                      <div class="dropdown">
                        <button type="button" class="btn btn-icon btn-sm btn-ghost-secondary rounded-circle" id="navbarNotificationsDropdownSettings" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="bi-three-dots-vertical"></i>
                        </button>

                        <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="navbarNotificationsDropdownSettings">
                          <span class="dropdown-header">Settings</span>
                          <a class="dropdown-item" href="#">
                            <i class="bi-archive dropdown-item-icon"></i> Archive all
                          </a>
                          <a class="dropdown-item" href="#">
                            <i class="bi-check2-all dropdown-item-icon"></i> Mark all as read
                          </a>
                          <a class="dropdown-item" href="#">
                            <i class="bi-toggle-off dropdown-item-icon"></i> Disable notifications
                          </a>
                          <a class="dropdown-item" href="#">
                            <i class="bi-gift dropdown-item-icon"></i> What's new?
                          </a>
                          <div class="dropdown-divider"></div>
                          <span class="dropdown-header">Feedback</span>
                          <a class="dropdown-item" href="#">
                            <i class="bi-chat-left-dots dropdown-item-icon"></i> Report
                          </a>
                        </div>
                      </div>
                      <!-- End Unfold -->
                    </div>
                    <!-- End Header -->

                    <!-- Nav -->
                    <ul class="nav nav-tabs nav-justified" id="notificationTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" href="#notificationNavOne" id="notificationNavOne-tab" data-bs-toggle="tab" data-bs-target="#notificationNavOne" role="tab" aria-controls="notificationNavOne" aria-selected="true">Messages (3)</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#notificationNavTwo" id="notificationNavTwo-tab" data-bs-toggle="tab" data-bs-target="#notificationNavTwo" role="tab" aria-controls="notificationNavTwo" aria-selected="false">Archived</a>
                      </li>
                    </ul>
                    <!-- End Nav -->

                    <!-- Body -->
                    <div class="card-body-height">
                      <!-- Tab Content -->
                      <div class="tab-content" id="notificationTabContent">
                        <div class="tab-pane fade show active" id="notificationNavOne" role="tabpanel" aria-labelledby="notificationNavOne-tab">
                          <!-- List Group -->
                          <ul class="list-group list-group-flush navbar-card-list-group">
                            <!-- Item -->
                            <li class="list-group-item form-check-select">
                              <div class="row">
                                <div class="col-auto">
                                  <div class="d-flex align-items-center">
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="notificationCheck1" checked>
                                      <label class="form-check-label" for="notificationCheck1"></label>
                                      <span class="form-check-stretched-bg"></span>
                                    </div>
                                    <!-- <img class="avatar avatar-sm avatar-circle" src="../assets/img/160x160/img3.jpg" alt="Image Description"> -->
                                  </div>
                                </div>
                                <!-- End Col -->

                                <div class="col ms-n2">
                                  <h5 class="mb-1">Brian Warner</h5>
                                  <p class="text-body fs-5">changed an issue from "In Progress" to <span class="badge bg-success">Review</span></p>
                                </div>
                                <!-- End Col -->

                                <small class="col-auto text-muted text-cap">2hr</small>
                                <!-- End Col -->
                              </div>
                              <!-- End Row -->

                              <a class="stretched-link" href="#"></a>
                            </li>
                            <!-- End Item -->

                            <!-- Item -->
                            <li class="list-group-item form-check-select">
                              <div class="row">
                                <div class="col-auto">
                                  <div class="d-flex align-items-center">
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="notificationCheck2" checked>
                                      <label class="form-check-label" for="notificationCheck2"></label>
                                      <span class="form-check-stretched-bg"></span>
                                    </div>
                                    <div class="avatar avatar-sm avatar-soft-dark avatar-circle">
                                      <span class="avatar-initials">K</span>
                                    </div>
                                  </div>
                                </div>
                                <!-- End Col -->

                                <div class="col ms-n2">
                                  <h5 class="mb-1">Klara Hampton</h5>
                                  <p class="text-body fs-5">mentioned you in a comment</p>
                                  <blockquote class="blockquote blockquote-sm">
                                    Nice work, love! You really nailed it. Keep it up!
                                  </blockquote>
                                </div>
                                <!-- End Col -->

                                <small class="col-auto text-muted text-cap">10hr</small>
                                <!-- End Col -->
                              </div>
                              <!-- End Row -->

                              <a class="stretched-link" href="#"></a>
                            </li>
                            <!-- End Item -->

                            <!-- Item -->
                            <li class="list-group-item form-check-select">
                              <div class="row">
                                <div class="col-auto">
                                  <div class="d-flex align-items-center">
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="notificationCheck3" checked>
                                      <label class="form-check-label" for="notificationCheck3"></label>
                                      <span class="form-check-stretched-bg"></span>
                                    </div>
                                    <div class="avatar avatar-sm avatar-circle">
                                      <!-- <img class="avatar-img" src="../assets/img/160x160/img10.jpg" alt="Image Description"> -->
                                    </div>
                                  </div>
                                </div>
                                <!-- End Col -->

                                <div class="col ms-n2">
                                  <h5 class="mb-1">Ruby Walter</h5>
                                  <p class="text-body fs-5">joined the Slack group HS Team</p>
                                </div>
                                <!-- End Col -->

                                <small class="col-auto text-muted text-cap">3dy</small>
                                <!-- End Col -->
                              </div>
                              <!-- End Row -->

                              <a class="stretched-link" href="#"></a>
                            </li>
                            <!-- End Item -->

                            <!-- Item -->
                            <li class="list-group-item form-check-select">
                              <div class="row">
                                <div class="col-auto">
                                  <div class="d-flex align-items-center">
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="notificationCheck4">
                                      <label class="form-check-label" for="notificationCheck4"></label>
                                      <span class="form-check-stretched-bg"></span>
                                    </div>
                                    <div class="avatar avatar-sm avatar-circle">
                                      <img class="avatar-img" src="../../svg/brands/google-icon.svg" alt="Image Description">
                                    </div>
                                  </div>
                                </div>
                                <!-- End Col -->

                                <div class="col ms-n2">
                                  <h5 class="mb-1">from Google</h5>
                                  <p class="text-body fs-5">Start using forms to capture the information of prospects visiting your Google website</p>
                                </div>
                                <!-- End Col -->

                                <small class="col-auto text-muted text-cap">17dy</small>
                                <!-- End Col -->
                              </div>
                              <!-- End Row -->

                              <a class="stretched-link" href="#"></a>
                            </li>
                            <!-- End Item -->

                            <!-- Item -->
                            <li class="list-group-item form-check-select">
                              <div class="row">
                                <div class="col-auto">
                                  <div class="d-flex align-items-center">
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="notificationCheck5">
                                      <label class="form-check-label" for="notificationCheck5"></label>
                                      <span class="form-check-stretched-bg"></span>
                                    </div>
                                    <div class="avatar avatar-sm avatar-circle">
                                      <!-- <img class="avatar-img" src="../assets/img/160x160/img7.jpg" alt="Image Description"> -->
                                    </div>
                                  </div>
                                </div>
                                <!-- End Col -->

                                <div class="col ms-n2">
                                  <h5 class="mb-1">Sara Villar</h5>
                                  <p class="text-body fs-5">completed <i class="bi-journal-bookmark-fill text-primary"></i> FD-7 task</p>
                                </div>
                                <!-- End Col -->

                                <small class="col-auto text-muted text-cap">2mn</small>
                                <!-- End Col -->
                              </div>
                              <!-- End Row -->

                              <a class="stretched-link" href="#"></a>
                            </li>
                            <!-- End Item -->
                          </ul>
                          <!-- End List Group -->
                        </div>

                        <div class="tab-pane fade" id="notificationNavTwo" role="tabpanel" aria-labelledby="notificationNavTwo-tab">
                          <!-- List Group -->
                          <ul class="list-group list-group-flush navbar-card-list-group">
                            <!-- Item -->
                            <li class="list-group-item form-check-select">
                              <div class="row">
                                <div class="col-auto">
                                  <div class="d-flex align-items-center">
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="notificationCheck6">
                                      <label class="form-check-label" for="notificationCheck6"></label>
                                      <span class="form-check-stretched-bg"></span>
                                    </div>
                                    <div class="avatar avatar-sm avatar-soft-dark avatar-circle">
                                      <span class="avatar-initials">A</span>
                                    </div>
                                  </div>
                                </div>
                                <!-- End Col -->

                                <div class="col ms-n2">
                                  <h5 class="mb-1">Anne Richard</h5>
                                  <p class="text-body fs-5">accepted your invitation to join Notion</p>
                                </div>
                                <!-- End Col -->

                                <small class="col-auto text-muted text-cap">1dy</small>
                                <!-- End Col -->
                              </div>
                              <!-- End Row -->

                              <a class="stretched-link" href="#"></a>
                            </li>
                            <!-- End Item -->

                            <!-- Item -->
                            <li class="list-group-item form-check-select">
                              <div class="row">
                                <div class="col-auto">
                                  <div class="d-flex align-items-center">
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="notificationCheck7">
                                      <label class="form-check-label" for="notificationCheck7"></label>
                                      <span class="form-check-stretched-bg"></span>
                                    </div>
                                    <div class="avatar avatar-sm avatar-circle">
                                      <!-- <img class="avatar-img" src="../assets/img/160x160/img5.jpg" alt="Image Description"> -->
                                    </div>
                                  </div>
                                </div>
                                <!-- End Col -->

                                <div class="col ms-n2">
                                  <h5 class="mb-1">Finch Hoot</h5>
                                  <p class="text-body fs-5">left Slack group HS projects</p>
                                </div>
                                <!-- End Col -->

                                <small class="col-auto text-muted text-cap">1dy</small>
                                <!-- End Col -->
                              </div>
                              <!-- End Row -->

                              <a class="stretched-link" href="#"></a>
                            </li>
                            <!-- End Item -->

                            <!-- Item -->
                            <li class="list-group-item form-check-select">
                              <div class="row">
                                <div class="col-auto">
                                  <div class="d-flex align-items-center">
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="notificationCheck8">
                                      <label class="form-check-label" for="notificationCheck8"></label>
                                      <span class="form-check-stretched-bg"></span>
                                    </div>
                                    <div class="avatar avatar-sm avatar-dark avatar-circle">
                                      <span class="avatar-initials">HS</span>
                                    </div>
                                  </div>
                                </div>
                                <!-- End Col -->

                                <div class="col ms-n2">
                                  <h5 class="mb-1">Htmlstream</h5>
                                  <p class="text-body fs-5">you earned a "Top endorsed" <i class="bi-patch-check-fill text-primary"></i> badge</p>
                                </div>
                                <!-- End Col -->

                                <small class="col-auto text-muted text-cap">6dy</small>
                                <!-- End Col -->
                              </div>
                              <!-- End Row -->

                              <a class="stretched-link" href="#"></a>
                            </li>
                            <!-- End Item -->

                            <!-- Item -->
                            <li class="list-group-item form-check-select">
                              <div class="row">
                                <div class="col-auto">
                                  <div class="d-flex align-items-center">
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="notificationCheck9">
                                      <label class="form-check-label" for="notificationCheck9"></label>
                                      <span class="form-check-stretched-bg"></span>
                                    </div>
                                    <div class="avatar avatar-sm avatar-circle">
                                      <!-- <img class="avatar-img" src="../assets/img/160x160/img8.jpg" alt="Image Description"> -->
                                    </div>
                                  </div>
                                </div>
                                <!-- End Col -->

                                <div class="col ms-n2">
                                  <h5 class="mb-1">Linda Bates</h5>
                                  <p class="text-body fs-5">Accepted your connection</p>
                                </div>
                                <!-- End Col -->

                                <small class="col-auto text-muted text-cap">17dy</small>
                                <!-- End Col -->
                              </div>
                              <!-- End Row -->

                              <a class="stretched-link" href="#"></a>
                            </li>
                            <!-- End Item -->

                            <!-- Item -->
                            <li class="list-group-item form-check-select">
                              <div class="row">
                                <div class="col-auto">
                                  <div class="d-flex align-items-center">
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="notificationCheck10">
                                      <label class="form-check-label" for="notificationCheck10"></label>
                                      <span class="form-check-stretched-bg"></span>
                                    </div>
                                    <div class="avatar avatar-sm avatar-soft-dark avatar-circle">
                                      <span class="avatar-initials">L</span>
                                    </div>
                                  </div>
                                </div>
                                <!-- End Col -->

                                <div class="col ms-n2">
                                  <h5 class="mb-1">Lewis Clarke</h5>
                                  <p class="text-body fs-5">completed <i class="bi-journal-bookmark-fill text-primary"></i> FD-134 task</p>
                                </div>
                                <!-- End Col -->

                                <small class="col-auto text-muted text-cap">2mts</small>
                                <!-- End Col -->
                              </div>
                              <!-- End Row -->

                              <a class="stretched-link" href="#"></a>
                            </li>
                            <!-- End Item -->
                          </ul>
                          <!-- End List Group -->
                        </div>
                      </div>
                      <!-- End Tab Content -->
                    </div>
                    <!-- End Body -->

                    <!-- Card Footer -->
                    <a class="card-footer text-center" href="#">
                      View all notifications <i class="bi-chevron-right"></i>
                    </a>
                    <!-- End Card Footer -->
                  </div>
                </div>
              </div>
              <!-- End Notification -->
            </li>

            <li class="nav-item d-none d-sm-inline-block">
              <!-- Apps -->
              <div class="dropdown">
                <button type="button" class="btn btn-icon btn-ghost-secondary rounded-circle" id="navbarAppsDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-dropdown-animation>
                  <i class="bi-app-indicator"></i>
                </button>

                <div class="dropdown-menu dropdown-menu-end dropdown-card navbar-dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="navbarAppsDropdown" style="width: 25rem;">
                  <div class="card">
                    <!-- Header -->
                    <div class="card-header">
                      <h4 class="card-title">Web apps &amp; services</h4>
                    </div>
                    <!-- End Header -->

                    <!-- Body -->
                    <div class="card-body card-body-height">
                      <a class="dropdown-item" href="#">
                        <div class="d-flex align-items-center">
                          <div class="flex-shrink-0">
                            <img class="avatar avatar-xs avatar-4x3" src="../../svg/brands/atlassian-icon.svg" alt="Image Description">
                          </div>
                          <div class="flex-grow-1 text-truncate ms-3">
                            <h5 class="mb-0">Atlassian</h5>
                            <p class="card-text text-body">Security and control across Cloud</p>
                          </div>
                        </div>
                      </a>

                      <a class="dropdown-item" href="#">
                        <div class="d-flex align-items-center">
                          <div class="flex-shrink-0">
                            <img class="avatar avatar-xs avatar-4x3" src="../../svg/brands/slack-icon.svg" alt="Image Description">
                          </div>
                          <div class="flex-grow-1 text-truncate ms-3">
                            <h5 class="mb-0">Slack <span class="badge bg-primary rounded-pill text-uppercase ms-1">Try</span></h5>
                            <p class="card-text text-body">Email collaboration software</p>
                          </div>
                        </div>
                      </a>

                      <a class="dropdown-item" href="#">
                        <div class="d-flex align-items-center">
                          <div class="flex-shrink-0">
                            <img class="avatar avatar-xs avatar-4x3" src="../../svg/brands/google-webdev-icon.svg" alt="Image Description">
                          </div>
                          <div class="flex-grow-1 text-truncate ms-3">
                            <h5 class="mb-0">Google webdev</h5>
                            <p class="card-text text-body">Work involved in developing a website</p>
                          </div>
                        </div>
                      </a>

                      <a class="dropdown-item" href="#">
                        <div class="d-flex align-items-center">
                          <div class="flex-shrink-0">
                            <img class="avatar avatar-xs avatar-4x3" src="../../svg/brands/frontapp-icon.svg" alt="Image Description">
                          </div>
                          <div class="flex-grow-1 text-truncate ms-3">
                            <h5 class="mb-0">Frontapp</h5>
                            <p class="card-text text-body">The inbox for teams</p>
                          </div>
                        </div>
                      </a>

                      <a class="dropdown-item" href="#">
                        <div class="d-flex align-items-center">
                          <div class="flex-shrink-0">
                            <img class="avatar avatar-xs avatar-4x3" src="../../svg/illustrations/review-rating-shield.svg" alt="Image Description">
                          </div>
                          <div class="flex-grow-1 text-truncate ms-3">
                            <h5 class="mb-0">HS Support</h5>
                            <p class="card-text text-body">Customer service and support</p>
                          </div>
                        </div>
                      </a>

                      <a class="dropdown-item" href="#">
                        <div class="d-flex align-items-center">
                          <div class="flex-shrink-0">
                            <div class="avatar avatar-sm avatar-soft-dark">
                              <span class="avatar-initials"><i class="bi-grid"></i></span>
                            </div>
                          </div>
                          <div class="flex-grow-1 text-truncate ms-3">
                            <h5 class="mb-0">More Front products</h5>
                            <p class="card-text text-body">Check out more HS products</p>
                          </div>
                        </div>
                      </a>
                    </div>
                    <!-- End Body -->

                    <!-- Footer -->
                    <a class="card-footer text-center" href="#">
                      View all apps <i class="bi-chevron-right"></i>
                    </a>
                    <!-- End Footer -->
                  </div>
                </div>
              </div>
              <!-- End Apps -->
            </li>

            <li class="nav-item d-none d-sm-inline-block">
              <!-- Activity -->
              <button class="btn btn-ghost-secondary btn-icon rounded-circle" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasActivityStream" aria-controls="offcanvasActivityStream">
                <i class="bi-x-diamond"></i>
              </button>
              <!-- Activity -->
            </li>

            <li class="nav-item">
              <!-- Style Switcher -->
              <div class="dropdown ">
                <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle" id="selectThemeDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-dropdown-animation=""><i class="bi-brightness-high"></i></button>

                <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="selectThemeDropdown" style="opacity: 1;">
                  <Link class="dropdown-item active" method="post" onFinish="() => {alert('hi')}" :href="route('userSettings.setAppearance')" :data="{'value': 'light'}" data-icon="bi-brightness-high" data-value="default">
                    <i class="bi-brightness-high me-2"></i>
                    <span class="text-truncate" title="Lichte modus">Lichte modus</span>
                  </Link>
                  <Link class="dropdown-item" method="post" :href="route('userSettings.setAppearance')" :data="{'value': 'dark'}" data-icon="bi-moon" data-value="dark">
                    <i class="bi-moon me-2"></i>
                    <span class="text-truncate" title="Donkere modus">Donkere modus</span>
                  </Link>
                </div>
              </div>

              <!-- End Style Switcher -->
            </li>

            <li class="nav-item">
              <!-- Account -->
              <div class="dropdown">
                <a class="navbar-dropdown-account-wrapper" href="javascript:;" id="accountNavbarDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" data-bs-dropdown-animation>
                  <div class="avatar avatar-sm avatar-circle">
                    <!-- <img class="avatar-img" src="../assets/img/160x160/img6.jpg" alt="Image Description"> -->
                    <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                  </div>
                </a>

                <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-account" aria-labelledby="accountNavbarDropdown" style="width: 16rem;">
                  <div class="dropdown-item-text">
                    <div class="d-flex align-items-center">
                      <div class="avatar avatar-sm avatar-circle">
                        <!-- <img class="avatar-img" src="../assets/img/160x160/img6.jpg" alt="Image Description"> -->
                      </div>
                      <div class="flex-grow-1 ms-3">
                        <h5 class="mb-0">{{ $page.props.auth.user.name }}</h5>
                        <p class="card-text text-body">{{ $page.props.auth.user.email }}</p>
                      </div>
                    </div>
                  </div>

                  <div class="dropdown-divider"></div>

                  <!-- Dropdown -->
                  <div class="dropdown">
                    <a class="navbar-dropdown-submenu-item dropdown-item dropdown-toggle" href="javascript:;" id="navSubmenuPagesAccountDropdown1" data-bs-toggle="dropdown" aria-expanded="false">Set status</a>

                    <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-sub-menu" aria-labelledby="navSubmenuPagesAccountDropdown1">
                      <a class="dropdown-item" href="#">
                        <span class="legend-indicator bg-success me-1"></span> Available
                      </a>
                      <a class="dropdown-item" href="#">
                        <span class="legend-indicator bg-danger me-1"></span> Busy
                      </a>
                      <a class="dropdown-item" href="#">
                        <span class="legend-indicator bg-warning me-1"></span> Away
                      </a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#"> Reset status
                      </a>
                    </div>
                  </div>
                  <!-- End Dropdown -->

                  <a class="dropdown-item" :href="route('profile.edit')">Profile &amp; account</a>
                  <a class="dropdown-item" href="#">Settings</a>

                  <div class="dropdown-divider"></div>

                  <a class="dropdown-item" href="#">
                    <div class="d-flex align-items-center">
                      <div class="flex-shrink-0">
                        <div class="avatar avatar-sm avatar-dark avatar-circle">
                          <span class="avatar-initials">HS</span>
                        </div>
                      </div>
                      <div class="flex-grow-1 ms-2">
                        <h5 class="mb-0">Htmlstream <span class="badge bg-primary rounded-pill text-uppercase ms-1">PRO</span></h5>
                        <span class="card-text">hs.example.com</span>
                      </div>
                    </div>
                  </a>

                  <div class="dropdown-divider"></div>

                  <!-- Dropdown -->
                  <div class="dropdown">
                    <a class="navbar-dropdown-submenu-item dropdown-item dropdown-toggle" href="javascript:;" id="navSubmenuPagesAccountDropdown2" data-bs-toggle="dropdown" aria-expanded="false">Customization</a>

                    <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-sub-menu" aria-labelledby="navSubmenuPagesAccountDropdown2">
                      <a class="dropdown-item" href="#">
                        Invite people
                      </a>
                      <a class="dropdown-item" href="#">
                        Analytics
                        <i class="bi-box-arrow-in-up-right"></i>
                      </a>
                      <a class="dropdown-item" href="#">
                        Customize Front
                        <i class="bi-box-arrow-in-up-right"></i>
                      </a>
                    </div>
                  </div>
                  <!-- End Dropdown -->

                  <a class="dropdown-item" href="#">Manage team</a>

                  <div class="dropdown-divider"></div>

                  <Link class="dropdown-item" :href="route('logout')" as="button" method="post">Uitloggen</Link>
                </div>
              </div>
              <!-- End Account -->
            </li>
          </ul>
          <!-- End Navbar -->
        </div>
        <!-- End Secondary Content -->

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContainerNavDropdown" aria-controls="navbarContainerNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-default">
            <i class="bi-list"></i>
          </span>
          <span class="navbar-toggler-toggled">
            <i class="bi-x"></i>
          </span>
        </button>
        <!-- End Toggler -->

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="navbarContainerNavDropdown">
          <ul class="navbar-nav">

            <li class="nav-item" v-for="navItem in navItems" :key="navItem.name">
              <a class="nav-link" :class="{'active': route().current(navItem.routeName)}" :href="route(navItem.routeName)">
                <i class="dropdown-item-icon" :class="navItem.icon"></i> {{ navItem.name }}
              </a>
            </li>

          </ul>

        </div>
        <!-- End Collapse -->
      </nav>
    </div>
  </header>
  <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main" class="main">
        
        <!-- Content -->
        <div class="content container">
            <slot />
        </div>
    </main>
</template>
