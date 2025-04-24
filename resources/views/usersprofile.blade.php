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
     <div class="dropdown-item" onclick="showSection(event, 'privacy-section')">Privacy Settings</div>
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
       <div class="dropdown-content" id="notification-dropdown">
       <div class="dropdown-item">Order Update</div>
       <div class="dropdown-item">Jowley's Crafts Update</div>
       <div class="dropdown-item">Notification Settings</div>
       </div>
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
                <button class="action-btn edit-btn" data-id="{{ $address->id }}">
                    <i class="fas fa-edit"></i> Edit
                </button>
                <button class="action-btn delete-btn" data-id="{{ $address->id }}">
                    <i class="fas fa-trash"></i> Delete
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
        <option value="">-- Select City --</option>
        <option value="Legazpi">Legazpi</option>
        <option value="Daraga">Daraga</option>
        <option value="Tabaco">Tabaco</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label" style="font-size: 15px;">Barangay</label>
      <select class="form-control" id="barangay" name="barangay" style="font-size: 15px;" required>
        <option value="">-- Select Barangay --</option>
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
    
    <div class="mt-4">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="font-size: 14px; padding: 10px;">
              Cancel
            </button>
      <button type="submit" class="btn btn-primary" style="font-size: 14px; padding: 10px;">
        Save Address
      </button>
    </div>
  </form>
</div>

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
    initializeModal(); // Always initialize regardless of display state
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
    // Remove active class from all buttons
    document.querySelectorAll('.address-label-btn').forEach(btn => {
      btn.classList.remove('active', 'btn-primary');
      btn.classList.add('btn-outline-primary');
    });
    
    // Add active class to clicked button
    this.classList.add('active', 'btn-primary');
    this.classList.remove('btn-outline-primary');
    
    // Update hidden input value
    document.getElementById('addressLabel').value = this.dataset.label;
  });
});
function initializeSectionSwitching() {
    document.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', function(e) {
            // Remove active class from all items
            document.querySelectorAll('.dropdown-item').forEach(i => i.classList.remove('active'));
            
            // Add active class to clicked item
            this.classList.add('active');
            
            // Get target section from onclick attribute
            const sectionId = this.getAttribute('onclick')?.match(/'(.*?)'/)?.[1];
            if (sectionId) {
                // Hide all sections
                document.querySelectorAll('.content-section').forEach(s => {
                    s.style.display = 'none';
                });
                
                // Show target section
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
  Legazpi: ["EM's Barrio", "Bonot", "Rawis", "Ilihan", "Taysan"],
  Daraga: ["Bañag", "Tagas", "Binitayan", "Sagpon"],
  Tabaco: ["Baranghawon", "Cobo", "Oas", "Mayon", "Matagbac"]
};

document.getElementById('city').addEventListener('change', function () {
  const city = this.value;
  const barangaySelect = document.getElementById('barangay');

  // Clear previous options
  barangaySelect.innerHTML = '<option value="">-- Select Barangay --</option>';

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
</script>
</body>
</html>