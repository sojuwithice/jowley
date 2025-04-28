<?php 
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$accountCreationDate = isset($_SESSION["created_at"]) ? $_SESSION["created_at"] : "2024-01-01";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jowley's Crafts - Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Gotu&family=Oleo+Script+Swash+Caps:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="css/userp.css">
</head>
<body>

<div class="top-header scroll-fade">
  <div class="left">
    <span>Follow us on</span>
      <a href="#"><i class="fab fa-facebook"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
      <a href="#"><i class="fab fa-tiktok"></i></a>
  </div>
  
  <div class="right">
    @guest
        <a href="{{ url('/Register') }}" class="signup">Sign Up</a>
        <a href="{{ route('LoginSignUp') }}" class="login">Log in</a>
    @else
        <!-- Notifications and Profile Menu for logged-in users -->
        <a href="#" class="notification">
            <i class="fas fa-bell"></i> Notification
        </a>
        <a href="#" class="user-profile" id="profileMenuTrigger">
            <i class="fas fa-user"></i> {{ Auth::user()->username }}
        </a>

        <div id="profileMenu" class="profile-menu">
            <ul>
                <li><a href="{{ route('usersprofile') }}">My Profile</a></li>
                <li><a href="#">My Purchases</a></li>
                <li><a href="{{ route('logout') }}">Logout</a></li>

            </ul>
        </div>
    @endguest
</div>

    </div>
</div>
<header>
 <a href="#" class="logo">Jowley's Crafts</a>
   <nav class="navbar">
     <a href="#home">Home</a>
     <a href="#products">Products</a>
     <a href="#faqs">FAQs</a>
   </nav>
 <div class="header-right">
   <div class="search-bar">
     <input type="text" placeholder="Search...">
       <button><i class="fas fa-search"></i></button>
 </div>
    <div class="icons">
     <a href="{{ route('cart') }}" class="fas fa-shopping-cart"></a>
    </div>
 </div>
</header>

<section class="profile-container">
 <aside class="sidebar">
   <div class="user-info">
     <img src="image/editusw.png" class="users-i">
     <span>{{ Auth::user()->username }}</span>
   </div>
     <nav class="pmenu">
     <div class="menu-item">
        <button class="menu-button" onclick="toggleDropdown('account-dropdown')">
        <img src="image/userp.png" class="account-icon" width="25" height="25">
        <span>My Account</span> </button>
     <div class="dropdown-content" id="account-dropdown">
     <div class="dropdown-item" onclick="showSection(event, 'profile-section')">Profile</div>
     <div class="dropdown-item" onclick="showSection(event, 'addresses-section'); handleAddressSection();">Addresses</div>
     <div class="dropdown-item" onclick="showSection(event, 'password-section')">Change Password</div>
    </div>
    </div>
       <div class="menu-item">
         <button class="menu-button" onclick="toggleDropdown('purchase-dropdown')">
         <img src="image/mypurchase.png" class="mypurchase" width="25" height="25">
         <span>My Purchase</span></button>
       </div>
       <div class="menu-item">
         <button class="menu-button" onclick="toggleDropdown('notification-dropdown')">
         <img src="image/notification.png" class="notification-i" width="25" height="25">
         <span>Notification</span></button>
       </div>
   </nav>
</aside>
   <main class="profile-content">
      <div id="profile-section" class="content-section">
         <h2>My Profile</h2>
           <p>Manage and protect your account</p>
       <div class="line"></div>
       <div class="profile-form">
       <div class="profile-picture">
          <img id="profile-img" src="image/squarep.png" style="width: 160px; height: 160px; justify-content:center; display:flex;" alt="Profile Preview">
          <input type="file" id="imageUpload" accept="image/*" onchange="previewImage(event)" style="display: none;">
          <label for="imageUpload" class="btn-img" style="cursor: pointer;">Select Image</label>
            <p>File size maximum 1MB</p>
       </div>
       <form action="{{ route('update.profile') }}" method="POST">
       @csrf
       <label for="username">Username:</label>
<div class="input-container d-flex align-items-center gap-2">
    <input type="text" id="username" name="username" value="{{ Auth::user()->username }}" readonly>
    <i class="fas fa-edit edit-icon" onclick="enableEdit('username')"></i>
</div>

<label for="email">Email Address:</label>
<div class="input-container d-flex align-items-center gap-2">
    <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
    <i class="fas fa-edit edit-icon" onclick="enableEdit('email')"></i>
</div>

<label for="number">Phone Number:</label>
<div class="input-container d-flex align-items-center gap-2"> <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone) }}" class="form-control" id="phone">
    <i class="fas fa-edit edit-icon" onclick="enableEdit('number')"></i>
</div>
<label>Gender:</label>
<div class="gender-toggle">
    <input type="radio" id="female" name="gender" value="female" {{ Auth::user()->gender == 'female' ? 'checked' : '' }}>
    <label for="female">Female</label>
    <input type="radio" id="male" name="gender" value="male" {{ Auth::user()->gender == 'male' ? 'checked' : '' }}>
    <label for="male">Male</label>
    <input type="radio" id="others" name="gender" value="others" {{ Auth::user()->gender == 'others' ? 'checked' : '' }}>
    <label for="others">Others</label>
</div>
<label for="dob">Date of Birth:</label>
<div class="input-container">
    <input type="date" id="dob" name="dob" value="{{ \Carbon\Carbon::parse(Auth::user()->dob)->toDateString() ?? '' }}">
</div>

           <button type="submit" class="save-button">Save Changes</button>
   </form>
  </div>
 </div>
 @auth
<div id="addresses-section" class="content-section" style="display: none;">
    <h2>My Addresses</h2>
    <p>Manage your shipping addresses</p>
    <div class="line"></div>

    <div class="address-container">
        <button class="add-address-btn" data-bs-toggle="modal" data-bs-target="#addAddressModal">
            Add New Address
        </button>

        <div class="address-list">
    @forelse (auth()->user()->addresses as $address)
        <div class="address-card">
            <div class="address-details">
                <h4>{{ $address->full_name }}</h4>
                <p class="phone-number">
                    <i class="fas fa-phone"></i> {{ $address->phone_number }}
                </p>
                <p class="address-text">
                    <i class="fas fa-map-marker-alt"></i>
                    {{ $address->street }},
                    {{ $address->barangay }},
                    {{ $address->city }},
                    Albay
                </p>
                @if ($address->is_default)
                    <span class="default-badge">Default</span>
                @endif
            </div>
            <div class="address-card-actions">
    <button class="edit-btn" data-id="{{ $address->id }}">
        <i class="fas fa-edit me-1"></i> Edit
    </button>
    <button class="delete-btn" data-id="{{ $address->id }}">
        <i class="fas fa-trash me-1"></i> Delete
    </button>
</div>
</div>
    @empty
        <p style="padding: 15px; font-size: 16px;">You don't have addresses yet.</p>
    @endforelse
</div>

    </div>
</div>
@endauth

	<div id="password-section" class="content-section" style="display: none;">
            <h2>Change Password</h2>
             <p>Update your account password</p>
        <div class="line"></div>
        <div class="password-form">
    @if (session('error'))
        <div style="color: red; margin-bottom: 10px;">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div style="color: green; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <div class="input-container">
            <label for="current-password">Current Password:</label>
            <input type="password" id="current-password" name="current_password" required>
        </div>

        <div class="input-container">
            <label for="new-password">New Password:</label>
            <input type="password" id="new-password" name="new_password" required>
        </div>

        <div class="input-container">
            <label for="confirm-password">Confirm New Password:</label>
            <input type="password" id="confirm-password" name="confirm_password" required>
        </div>

        <button type="submit" class="save-button">Update Password</button>
    </form>
</div>

         <div id="privacy-section" class="content-section" style="display: none;">
            <h2>Privacy Settings</h2>
            <p>Control your privacy preferences</p>
         <div class="line"></div>
         <div class="privacy-form">
	  <form>
         <div class="privacy-option">
            <h4>Profile Visibility</h4>
         <div class="toggle-option">
             <input type="radio" id="public-profile" name="profile-visibility" value="public" checked>
               <label for="public-profile">Public</label>
             <input type="radio" id="private-profile" name="profile-visibility" value="private">
               <label for="private-profile">Private</label>
         </div>
        </div>
          <div class="privacy-option">
              <h4>Email Notifications</h4>
          <div class="toggle-switch">
               <input type="checkbox" id="promotional-emails" checked>
               <label for="promotional-emails">Receive promotional emails</label>
         </div>
          <div class="toggle-switch">
               <input type="checkbox" id="order-updates" checked>
               <label for="order-updates">Receive order updates</label>
          </div>
          </div>
          <div class="privacy-option">
            	<h4>Data Sharing</h4>
          <div class="toggle-switch">
                <input type="checkbox" id="analytics-sharing">
                <label for="analytics-sharing">Allow analytics data sharing</label>
          </div>
         </div>   
               <button type="submit" class="save-button">Save Privacy Settings</button>
        </form>
       </div>
     </div>
   </main>
</section>
<!-- Bootstrap Modal for Address -->
<div class="modal fade" id="addAddressModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="margin-left: 15px; margin-right: 15px;">
      <div class="modal-header">
        <h5 class="modal-title" style="color: #ec32b5; font-size:20px; margin-left: 15px; margin-right: 15px;">Add New Address</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" style="padding-left: 25px; padding-right: 25px;">
      <form id="addressForm">
    <div class="mb-3">
      <label class="form-label" style="font-size: 15px;">Full Name</label>
      <input type="text" class="form-control" name="full_name" style="font-size: 15px;" required>
    </div>

    <div class="mb-3">
      <label class="form-label" style="font-size: 15px;">Phone Number</label>
      <input type="tel" class="form-control" name="phone_number" style="font-size: 15px;" 
             pattern="[0-9]*" 
             oninput="this.value = this.value.replace(/[^0-9]/g, '')"
             maxlength="15"
             required>
    </div>

    <div class="mb-3">
      <label class="form-label" style="font-size: 15px;">City</label>
      <select class="form-control" id="city" name="city" style="font-size: 15px;" required>
        <option value="">Select City/Municipality</option>
        <option value="Bacacay">Bacacay</option>
        <option value="Camalig">Camalig</option>
        <option value="Daraga">Daraga</option>
        <option value="Guinobatan">Guinobatan</option>
        <option value="Jovellar">Jovellar</option>
        <option value="Legazpi">Legazpi City</option>
        <option value="Libon">Libon</option>
        <option value="Ligao">Ligao City</option>
        <option value="Malilipot">Malilipot</option>
        <option value="Malinao">Malinao</option>
        <option value="Manito">Manito</option>
        <option value="Oas">Oas</option>
        <option value="Pioduran">Pioduran</option>
        <option value="Polangui">Polangui</option>
        <option value="RapuRapu">Rapu-Rapu</option>
        <option value="SantoDomingo">Santo Domingo </option>
        <option value="Tabaco">Tabaco City</option>
        <option value="Tiwi">Tiwi</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label" style="font-size: 15px;">Barangay</label>
      <select class="form-control" id="barangay" name="barangay" style="font-size: 15px;" required>
        <option value="">Select Barangay</option>
        <option value="Jovellar"></option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label" style="font-size: 15px;">Street Building House No. Barangay</label>
      <textarea class="form-control" name="street" style="font-size: 15px;" rows="2" required></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label" style="font-size: 15px;">Province</label>
      <input type="text" class="form-control" value="Albay" disabled>
    </div> 

    <div class="mb-3">
      <label class="form-label" style="font-size: 15px;">Label as:</label> 
      <div class="d-flex gap-2">
        <button type="button" class="address-label-btn active" 
                data-label="home" style="font-size: 13px; padding: 5px 13px;">
          <i class="bi bi-house-door me-2"></i>Home</button>
        <button type="button" class="address-label-btn" 
                data-label="work" style="font-size: 13px; padding: 5px 13px;">
          <i class="bi bi-briefcase me-2"></i>Work</button>
      </div>
      <input type="hidden" name="label" id="addressLabel" value="home">
    </div>

    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="defaultAddress" name="is_default" value="1">
      <label class="form-check-label" for="defaultAddress" style="font-size: 14px;">
        Set as default address
      </label>
    </div>
    <div class="d-flex justify-content-end">
    <div class="mt-4">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="font-size: 14px; padding: 6px;">
              Cancel
            </button>
      <button type="submit" class="btn btn-primary" style="font-size: 14px; padding: 6px;">
        Save Address
      </button>
    </div>
  </form>
</div>
</div>
</div>
</div>
</div>
<!-- Edit Address Modal -->
<div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="margin-left: 15px; margin-right: 15px;">
            <div class="modal-header">
            <h5 class="modal-title" style="color: #ec32b5; font-size:20px; margin-left: 15px; margin-right: 15px;">Edit Address</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
            <form id="editAddressForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="modal-body" style="padding-left: 25px; padding-right: 25px;">
                <div class="mb-3">
                  <label class="form-label" style="font-size: 15px;">Full Name</label>
                  <input type="text" class="form-control" name="full_name" style="font-size: 15px;" required>
                </div>
                <div class="mb-3">
      <label class="form-label" style="font-size: 15px;">Phone Number</label>
      <input type="tel" class="form-control" name="phone_number" style="font-size: 15px;" 
             pattern="[0-9]*" 
             oninput="this.value = this.value.replace(/[^0-9]/g, '')"
             maxlength="15"
             required>
    </div>

    <div class="mb-3">
      <label class="form-label" style="font-size: 15px;">City</label>
      <select class="form-control" id="city" name="city" style="font-size: 15px;" required>
        <option value="">Select City/Municipality</option>
        <option value="Bacacay">Bacacay</option>
        <option value="Camalig">Camalig</option>
        <option value="Daraga">Daraga</option>
        <option value="Guinobatan">Guinobatan</option>
        <option value="Jovellar">Jovellar</option>
        <option value="Legazpi">Legazpi City</option>
        <option value="Libon">Libon</option>
        <option value="Ligao">Ligao City</option>
        <option value="Malilipot">Malilipot</option>
        <option value="Malinao">Malinao</option>
        <option value="Manito">Manito</option>
        <option value="Oas">Oas</option>
        <option value="Pioduran">Pioduran</option>
        <option value="Polangui">Polangui</option>
        <option value="RapuRapu">Rapu-Rapu</option>
        <option value="SantoDomingo">Santo Domingo </option>
        <option value="Tabaco">Tabaco City</option>
        <option value="Tiwi">Tiwi</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label" style="font-size: 15px;">Barangay</label>
      <select class="form-control" id="barangay" name="barangay" style="font-size: 15px;" required>
        <option value="">Select Barangay</option>
        <option value="Jovellar"></option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label" style="font-size: 15px;">Street Building House No. Barangay</label>
      <textarea class="form-control" name="street" style="font-size: 15px;" rows="2" required></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label" style="font-size: 15px;">Province</label>
      <input type="text" class="form-control" value="Albay" disabled>
    </div> 

    <div class="mb-3">
      <label class="form-label" style="font-size: 15px;">Label as:</label> 
      <div class="d-flex gap-2">
        <button type="button" class="address-label-btn active" 
                data-label="home" style="font-size: 13px; padding: 5px 13px;">
          <i class="bi bi-house-door me-2"></i>Home</button>
        <button type="button" class="address-label-btn" 
                data-label="work" style="font-size: 13px; padding: 5px 13px;">
          <i class="bi bi-briefcase me-2"></i>Work</button>
      </div>
      <input type="hidden" name="label" id="addressLabel" value="home">
    </div>

    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="defaultAddress" name="is_default" value="1">
      <label class="form-check-label" for="defaultAddress" style="font-size: 14px;">
        Set as default address
      </label>
    </div>
    <div class="d-flex justify-content-end">
    <div class="mt-4">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="font-size: 14px; padding: 6px;">
              Cancel
            </button>
      <button type="submit" class="btn btn-primary" style="font-size: 14px; padding: 6px;">
        Save Changes
      </button>
    </div>
  </form>
</div>
</div>
</div>
</div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteAddressModal" tabindex="-1" aria-labelledby="deleteAddressModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content delete-modal">
      <div class="modal-header">
        <h5 class="modal-title" style="color: #ec32b5; font-size: 20px; text-align: center; width: 100%; padding: 0 15px;">Edit Address</h5>
      </div>
      <form id="deleteAddressForm" method="POST" action="">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          <p style="font-size:14px; text-align: center;">Are you sure you want to delete this address?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-cancel" data-bs-dismiss="modal" style="font-size: 12px; padding: 6px;">Cancel</button>
          <button type="submit" class="btn btn-primary" style="font-size: 12px; padding: 6px;">Delete Address</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all functionality
    checkUsernameEditable();
    initializeDropdowns();
    initializeModal();
    restoreActiveSection();
    setupDropdownCloser();
    initializeSectionSwitching();
});

function checkUsernameEditable() {
    const usernameField = document.getElementById('username');
    const creationDate = new Date("<?= $accountCreationDate ?>");
    const diffDays = Math.floor((new Date() - creationDate) / (1000 * 60 * 60 * 24));
    
    if (diffDays <= 30) {
        usernameField.removeAttribute('readonly');
    }
}

function initializeDropdowns() {
    document.querySelectorAll('.menu-button').forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            const dropdown = button.nextElementSibling;
            const isOpen = dropdown.style.display === 'block';
            
            // Close all dropdowns
            document.querySelectorAll('.dropdown-content').forEach(d => d.style.display = 'none');
            
            // Toggle current dropdown
            dropdown.style.display = isOpen ? 'none' : 'block';
        });
    });
}

function setupDropdownCloser() {
    // Close dropdowns when clicking outside
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.menu-item')) {
            document.querySelectorAll('.dropdown-content').forEach(d => d.style.display = 'none');
        }
    });

    // Close dropdowns when clicking items
    document.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', (e) => {
            e.stopPropagation();
            document.querySelectorAll('.dropdown-content').forEach(d => d.style.display = 'none');
        });
    });
}

function initializeModal() {
    const addAddressBtn = document.querySelector('.add-address-btn');
    if (addAddressBtn) {
        addAddressBtn.addEventListener('click', () => {
            new bootstrap.Modal(document.getElementById('addressModal')).show();
        });
    }
}
// Address Section Handler
function handleAddressSection() {
    initializeModal();
}

function initializeModal() {
    const triggerBtn = document.querySelector('.add-address-btn');
    if (triggerBtn) {
        triggerBtn.addEventListener('click', () => {
            new bootstrap.Modal(document.getElementById('addAddressModal')).show();
        });
    }
}

function showAddressModal() {
    const modal = new bootstrap.Modal(document.getElementById('addAddressModal'));
    modal.show();
}

function restoreActiveSection() {
    const activeSection = sessionStorage.getItem('activeSection') || 'profile-section';
    document.querySelectorAll('.content-section').forEach(section => {
        section.style.display = section.id === activeSection ? 'block' : 'none';
    });
}
document.querySelectorAll('.address-label-btn').forEach(button => {
  button.addEventListener('click', function() {
    document.querySelectorAll('.address-label-btn').forEach(btn => {
      btn.classList.remove('active', 'btn-primary');
      btn.classList.add('btn-outline-primary');
    });
    
    // Add active class to clicked button
    this.classList.add('active', 'btn-primary');
    this.classList.remove('btn-outline-primary');
 
    document.getElementById('addressLabel').value = this.dataset.label;
  });
});
function initializeSectionSwitching() {
    document.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', function(e) {
        
            document.querySelectorAll('.dropdown-item').forEach(i => i.classList.remove('active'));

            this.classList.add('active');

            const sectionId = this.getAttribute('onclick')?.match(/'(.*?)'/)?.[1];
            if (sectionId) {
               
                document.querySelectorAll('.content-section').forEach(s => {
                    s.style.display = 'none';
                });
                
                const targetSection = document.getElementById(sectionId);
                if (targetSection) {
                    targetSection.style.display = 'block';
                    sessionStorage.setItem('activeSection', sectionId);
                }
            }
        });
    });
}

// Image Preview Function
function previewImage(event) {
    const reader = new FileReader();
    const output = document.getElementById('profile-img');
    
    reader.onload = function() {
        output.src = reader.result;
        output.style.display = 'block';
    };
    
    if (event.target.files[0]) {
        reader.readAsDataURL(event.target.files[0]);
    }
}

document.getElementById('profileMenuTrigger').addEventListener('click', function(event) {
        event.preventDefault();
        const profileMenu = document.getElementById('profileMenu');
        profileMenu.style.display = (profileMenu.style.display === 'block') ? 'none' : 'block';
    });

    // Close the profile menu if clicked outside
    window.addEventListener('click', function(event) {
        const profileMenu = document.getElementById('profileMenu');
        if (!event.target.closest('#profileMenuTrigger') && !event.target.closest('#profileMenu')) {
            profileMenu.style.display = 'none';
        }
    });

    function enableEdit(fieldId) {
        const input = document.getElementById(fieldId);
        input.removeAttribute('readonly');
        input.focus();
    }

    const barangays = {

  Bacacay: ["Barangay 1 (Pob.)", "Barangay 2 (Pob.)", "Barangay 3 (Pob.)", "Barangay 4 (Pob.)","Barangay 5 (Pob.)","Barangay 6 (Pob.)", "Barangay 7 (Pob.)","Barangay 2 (Pob.)","Barangay 2 (Pob.)","Barangay 2 (Pob.)",
            "Barangay 8 (Pob.)", "Barangay 9 (Pob.)", "Barangay 10 (Pob.)", "Barangay 11 (Pob.)", "Barangay 12 (Pob.)", "Barangay 13 (Pob.)", "Barangay 14 (Pob.)", "Bariw", "Basud", "Bayandong", "Bariw", "Bonga", "Buang",
             "Busdac (San Jose)", "Cabasan", "Cagbulacao", "Cagraray", "Cajogutan", "Cawayan", "Damacan", "Gubat Ilawod", "Gubat Iraya Hindi Igang", "Langaton",  "Manaet", "Mapulang Daga",
            "Mataas", "Misibis", "Nahapunan", "Namanday", "Namantao", "Napao", "Panarayon", "Pigcobohan", "Pili Ilawod",
             "Pili Iraya", "Pongco (Lower Bonga)", "San Pablo", "San Pedro", "Sogod", "Sula", "Tambilagao (Tambognon)", "Tambongon (Tambilagao)", "Tanagan", "Uson", "Vinisitahan-Basud (Mainland)", "Vinisitahan-Napao (Lsland)"],
  Camalig: ["Anoling", "Baligang", "Bantonan", "Barangay 1 (Pob.)", "Barangay 2 (Pob.)",  "Barangay 3 (Pob.)",  "Barangay 4 (Pob.)",  "Barangay 5 (Pob.)",  "Barangay 6 (Pob.)",  "Barangay 7 (Pob.)", "Bariw", "Binandirahan", "Binitayan", 
            "Bongabong", "Cabagnan", "Cabraran Pequeno", "Caguiba", "Calabidongan", "Comun", "Cotmun", "Del Rosario", "Gapo", "Gotob", "Ilawod", "Iluluan", "Libod", "Ligban", "Mabunga", "Magogon", "Manawa", "Maninila", "Mina", "Miti", "Palanog", "Panoypoy", "Pariaan", "Quinartilan", "Quitinday", "Salungan", 
             "Solong", "Sulong", "Sua", "Sumalang", "Tagaytay", "Tagoytoy", "Taladong", "Taloto", "Taplacon", "Tinago", "Tumpa"], 
  Daraga:  ["Alcala", "Alobo", "Anislag", "Bagumbayan", "Balinad", "Bascaran", "Bañadero", "Bañag", "Bigao", "Binitayan", "Bongalon", "Budiao", "Burgos", "Busay", "Canarom", "Cullat", "Dela Paz", "Dinoronan", "Gabawan", "Gapo", "Ibaugan", "Ilawod Area", "Poblacion", "Inarado", "Kidaco", "Kilicao", "Kimantong", "Kinawitan", "Kiwalo", 
            "Lacag", "Mabini", "Malabog", "Malobago", "Maopi", "Market Area Poblacion", "Maroroy", "Matnog", "Mayon", "Mi-isi", "Nabasan", "Namantao", "Pandan", "Peñafrancia", "Sagpon", "Salvacion", "San Rafael", "San Ramon", "San Roque", "San Vicente Grande", "San Vicente Pequeño", "Sipi", "Tabon-tabon", "Tagas", "Talahib", "Villahermosa"],
  Guinobatan: ["Agpay", "Balite", "Banao", "Binogsacan Lower", "Binogsacan Upper", "Bololo", "Bubulusan", "Calzada", "Catomag", "Doña Mercedes", "Doña Tomasa", "Ilawod", "Inamnan Grande", "Inamnan Pequeño", "Inascan", "Iraya", "Lomacao", "Maguiron", "Maipon", "Malabnig", "Malipo", "Malobago", "Maninila", "Mapaco", "Marcial O. Rañola",
            "Masarawag", "Minto", "Morera", "Muladbucad Grande", "Muladbucad Pequeño", "Ongo", "Palanas", "Poblacion", "Pood", "Quibongbongan", "Quitago", "San Francisco", "San Jose", "San Rafael", "Sinungtan", "Tandarora", "Travesia" ],
  Jovellar:["Aurora Poblacion", "Bagacay", "Bautista", "Cabraran", "Calzada Poblacion", "Del Rosario", "Estrella", "Florista", "Mabini Poblacion", "Magsaysay Poblacion", "Mamlad", "Maogog", "Mercado Poblacion", "Plaza Poblacion", "Quitinday Poblacion", "Rizal Poblacion", "Salvacion", "San Isidro", "San Roque", "San Vicente", "Sinagaran", "Villa Paz", "White Deer Poblacion", ],
  Legazpi: ["Barangay 1-Em's Barrio", "Barangay 10-Cabugao", "Barangay 11-Maoyod Poblacion", "Barangay 12-Tula-tula", "Barangay 13-Ilawod West Poblacion", "Barangay 14-Ilawod Poblacion", "Barangay 15-Ilawod East Poblacion", "Barangay 16-Kawit-East Washington Drive", "Barangay 17-Rizal Street, Ilawod", "Barangay 18-Cabagñan West", "Barangay 19-Cabagñan", "Barangay 2-Em's Barrio South", "Barangay 20-Cabagñan East", "Barangay 21-Binanuahan West", "Barangay 22-Binanuahan East", "Barangay 23-Imperial Court Subd.", "Barangay 24-Rizal Street", "Barangay 25-Lapu-lapu", "Barangay 26-Dinagaan", "Barangay 27-Victory Village South", "Barangay 28-Victory Village North", "Barangay 29-Sabang", "Barangay 3-Em's Barrio East", "Barangay 30-Pigcale", "Barangay 31-Centro-Baybay", "Barangay 32-San Roque", "Barangay 33-PNR-Peñaranda St.-Iraya", 
          "Barangay 34-Oro Site-Magallanes St.", "Barangay 35-Tinago", "Barangay 36-Kapantawan", "Barangay 37-Bitano", "Barangay 38-Gogon", "Barangay 39-Bonot", "Barangay 4-Sagpon Poblacion", "Barangay 40-Cruzada", "Barangay 41-Bogtong", 
          "Barangay 42-Rawis", "Barangay 43-Tamaoyan", "Barangay 44-Pawa", "Barangay 45-Dita", "Barangay 46-San Joaquin", "Barangay 47-Arimbay", "Barangay 48-Bagong Abre", "Barangay 49-Bigaa", "Barangay 5-Sagmin Poblacion", "Barangay 50-Padang", "Barangay 51-Buyuan", "Barangay 52-Matanag", "Barangay 53-Bonga", "Barangay 54-Mabinit", "Barangay 55-Estanza", "Barangay 56-Taysan", "Barangay 57-Dap-dap", "Barangay 58-Buragwis", "Barangay 59-Puro", 
          "Barangay 6-Bañadero Poblacion", "Barangay 60-Lamba", "Barangay 61-Maslog", "Barangay 62-Homapon", "Barangay 63-Mariawa", "Barangay 64-Bagacay", "Barangay 65-Imalnod", "Barangay 66-Banquerohan", "Barangay 67-Bariis", "Barangay 68-San Francisco", "Barangay 69-Buenavista", "Barangay 7-Baño", "Barangay 70-Cagbacong", "Barangay 8-Bagumbayan", "Barangay 9-Pinaric" ],
  Libon: ["Alongong", "Apud", "Bacolod", "Bariw", "Bonbon", "Buga", "Bulusan", "Burabod", "Caguscos", "East Carisac", "Harigue", "Libtong", "Linao", "Mabayawas", "Macabugos", "Magallang", "Malabiga", "Marayag", "Matara", "Molosbolos", "Natasan", "Niño Jesus", "Nogpo", "Pantao", 
	      "Rawis", "Sagrada Familia", "Salvacion", "Sampongan", "San Agustin", "San Antonio", "San Isidro", "San Jose", "San Pascual", "San Ramon", "San Vicente", "Santa Cruz", "Talin-talin", "Tambo", "Villa Petrona", "West Carisac", 
	      "Zone I", "Zone II", "Zone III", "Zone IV", "Zone V", "Zone VI", "Zone VII"],
  Ligao: ["Abella", "Allang", "Amtic", "Bacong", "Bagumbayan", "Balanac", "Baligang", "Barayong", "Basag", "Batang", "Bay", "Binanowan", "Binatagan", "Bobonsuran", "Bonga", "Busac", "Busay", "Cabarian", "Calzada", "Catburawan",
        "Cavasi", "Culliat", "Dunao", "Francia", "Guilid", "Herrera", "Layon", "Macalidong", "Mahaba", "Malama", "Maonon", "Nabonton", "Nasisi", "Oma-oma", "Palapas", "Pandan", "Paulba", "Paulog", "Pinamaniquian", "Pinit",
        "Ranao-ranao", "San Vicente", "Santa Cruz", "Tagpo", "Tambo", "Tandarura", "Tastas", "Tinago", "Tinampo", "Tiongson", "Tomolin", "Tuburan", "Tula-tula Grande", "Tula-tula Pequeño", "Tupas"],
  Malilipot: ["Barangay I", "Barangay II", "Barangay III", "Barangay IV", "Barangay V", "Binitayan", "Calbayog", "Canaway", "Salvacion", "San Antonio Santicon", "San Antonio Sulong", "San Francisco", "San Isidro Ilawod", "San Isidro Iraya", "San Jose", "San Roque", "Santa Cruz", "Santa Teresa"],
  Malinao: ["Awang", "Bagatangki", "Bagumbayan", "Balading", "Balza", "Bariw", "Baybay", "Bulang", "Burabod", "Cabunturan", "Comun", "Diaro", "Estancia", "Jonop", "Labnig", "Libod", "Malolos", "Matalipni", "Ogob", "Pawa",  "Payahan", "Poblacion", "Quinarabasahan", "Santa Elena", "Soa", "Sugcad", "Tagoytoy", "Tanawan", "Tuliw"],
  Manito:["Balabagon", "Balasbas", "Bamban", "Buyo", "Cabacongan", "Cabit", "Cawayan", "Cawit", "Holugan", "It-ba", "Malobago", "Manumbalay", "Nagotgot", "Pawa", "Tinapian"],
  Oas: ["Badbad", "Badian", "Bagsa", "Bagumbayan", "Balogo", "Banao", "Bangiawon", "Bogtong", "Bongoran", "Busac", "Cadawag", "Cagmanaba", "Calaguimit", "Calpi", "Calzada", "Camagong", "Casinagan", "Centro Poblacion", "Coliat", "Del Rosario", "Gumabao", "Ilaor Norte", "Ilaor Sur", "Iraya Norte", "Iraya Sur", "Manga", "Maporong", "Maramba",
        "Matambo", "Mayag", "Mayao", "Moroponros", "Nagas", "Obaliw-Rinas", "Pistola", "Ramay", "Rizal", "Saban", "San Agustin", "San Antonio", "San Isidro", "San Jose", "San Juan", "San Miguel", "San Pascual", "San Ramon", "San Vicente", "Tablon", "Talisay", "Talongog", "Tapel", "Tobgon", "Tobog"],
  Pioduran: ["Agol", "Alabangpuro", "Banawan", "Barangay I", "Barangay II", "Barangay III", "Barangay IV", "Barangay V", "Basicao Coastal", "Basicao Interior", "Binodegahan", "Buenavista", "Buyo", "Caratagan", "Cuyaoyao", "Flores", "La Medalla",
        "Lawinon", "Macasitas", "Malapay", "Malidong", "Mamlad", "Marigondon", "Matanglad", "Nablangbulod", "Oringon", "Palapas", "Panganiran", "Rawis", "Salvacion", "Santo Cristo", "Sukip", "Tibabo"],
  Polangui: ["Agos", "Alnay", "Alomon", "Amoguis", "Anopol", "Apad", "Balaba", "Balangibang", "Balinad", "Basud", "Binagbangan", "Buyo", "Centro Occidental", "Centro Oriental", "Cepres", "Cotmon", "Cotnogan", "Danao", "Gabon", "Gamot", "Itaran", "Kinale", "Kinuartilan", "La Medalla",
  "La Purisima", "Lanigay", "Lidong", "Lourdes", "Magpanambo", "Magurang", "Matacon", "Maynaga", "Maysua", "Mendez", "Napo", "Pinagdapugan", "Ponso", "Salvacion", "San Roque", "Santa Cruz", "Santa Teresita", "Santicon", "Sugcad", "Ubaliw"],
  RapuRapu: ["Bagaobawan", "Batan", "Bilbao", "Binosawan", "Bogtong", "Buenavista", "Buhatan", "Calanaga", "Caracaran", "Carogcog", "Dap-dap", "Gaba", "Galicia", "Guadalupe", "Hamorawon", 
  "Lagundi", "Liguan", "Linao",  "Malobago", "Mananao", "Mancao", "Manila",  "Masaga", "Morocborocan", "Nagcalsot", "Pagcolbon", "Poblacion", "Sagrada", "San Ramon", "Santa Barbara", "Tinocawan", "Tinopan", "Viga", "Villahermosa"],
  SantoDomingo: ["Alimsog", "Bagong San Roque", "Buhatan", "Calayucay", "Del Rosario Poblacion", "Fidel Surtida", "Lidong", "Market Site Poblacion", "Nagsiya Poblacion", "Pandayan Poblacion", 
  "Salvacion", "San Andres", "San Fernando", "San Francisco Poblacion", "San Isidro", "San Juan Poblacion", "San Pedro Poblacion", "San Rafael Poblacion", "San Roque", "San Vicente Poblacion", "Santa Misericordia", "Santo Domingo Poblacion", "Santo Niño"],
  Tabaco: ["Agnas", "Bacolod", "Bangkilingan", "Bantayan", "Baranghawon", "Basagan", "Basud", "Bogñabong", "Bombon", "Bonot", "Buang", "Buhian", "Cabagñan", "Cobo", "Comon", "Cormidal", "Divino Rostro", "Fatima", "Guinobat", 
  "Hacienda", "Magapo", "Mariroc", "Matagbac", "Oras", "Oson", "Panal", "Pawa", "Pinagbobong", "Quinale Cabasan", "Quinastillojan", "Rawis", "Sagurong", "Salvacion", "San Antonio", "San Carlos", "San Isidro", "San Juan", "San Lorenzo", "San Ramon", "San Roque", "San Vicente", "Santo Cristo", "Sua-Igot", "Tabiguian", "Tagas", "Tayhi", "Visita"],
  Tiwi: ["Bagumbayan", "Bariis", "Baybay", "Belen", "Biyong", "Bolo", "Cale", "Cararayan", "Coro-coro", "Dap-dap",  "Gajo", "Joroan", "Libjo", "Libtong", "Matalibong", "Maynonong", "Mayong", "Misibis", "Naga", "Nagas", "Oyama", "Putsan", "San Bernardo", "Sogod", "Tigbi"]
};

document.getElementById('city').addEventListener('change', function () {
  const city = this.value;
  const barangaySelect = document.getElementById('barangay');

  // Clear previous options
  barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

  if (barangays[city]) {
    barangays[city].forEach(brgy => {
      const option = document.createElement('option');
      option.value = brgy;
      option.textContent = brgy;
      barangaySelect.appendChild(option);
    });
  }
});

document.getElementById('addressForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const form = new FormData(this);
  form.append('label', document.getElementById('addressLabel').value);
  form.append('is_default', document.getElementById('defaultAddress').checked ? 1 : 0);

  fetch("{{ route('addresses.store') }}", {
    method: "POST",
    headers: {
      "X-CSRF-TOKEN": "{{ csrf_token() }}"
    },
    body: form
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert("Address added successfully!");
      location.reload(); // or dynamically add to address list
    }
  });
});

document.addEventListener('DOMContentLoaded', function() {
    // Edit Button Handler
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            const addressId = this.getAttribute('data-id');
            const form = document.getElementById('editAddressForm');
            form.action = `/addresses/${addressId}`; 
            const modal = new bootstrap.Modal(document.getElementById('editAddressModal'));
            modal.show();
        });
    });

    // Delete Button Handler
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const addressId = this.getAttribute('data-id');
            const form = document.getElementById('deleteAddressForm');
            form.action = `/addresses/${addressId}`; 
            const modal = new bootstrap.Modal(document.getElementById('deleteAddressModal'));
            modal.show();
        });
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const topHeader = document.querySelector('.top-header');
    
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('show.bs.modal', () => {
            topHeader.classList.add('hidden');
        });
        
        modal.addEventListener('hidden.bs.modal', () => {
            if (!document.querySelector('.modal.show')) {
                topHeader.classList.remove('hidden');
            }
        });
    });
});

</script>
</body>
</html>