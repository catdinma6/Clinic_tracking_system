        <div class="wrapper">
            <div class="sidebar">

                <ul>
                    <li><a href="secretary.php"><i class="fas fa-home"></i>Dashboard</a></li>
                    <li><a href="secretary_edit_profile.php"><i class="fas fa-user-md"></i>Profile</a></li>
                    <li class="accordion"><a href="#"><i class="fas fa-users"></i>Patients</a></li>
                    <div class="panel">
                    <li><a href="secretary_all_patient.php"><i class="fas fa-user-bed"></i>All Patients</a></li>
                    <li><a href="secretary_add_patient.php"><i class="fas fa-user-bed"></i>Add New Patient</a></li>
                    </div>
                    <li class="accordion"><a href="#"><i class="fas fa-user-plus"></i>Admission</a></li>
                    <div class="panel">
                    <li><a href="secretary_view_admitted.php"><i class="fas fa-user-bed"></i>View Admitted</a></li>
                    <li><a href="secretary_add_admission.php"><i class="fas fa-user-bed"></i>New Admission</a></li>
                    </div>
                    <li class="accordion"><a href="#"><i class="fas fa-user-plus"></i>Appointments</a></li>
                    <div class="panel">
                    <li><a href="all_appointment.php"><i class="fas fa-user-bed"></i>View Appointments</a></li>
                    <li><a href="new_appointments.php"><i class="fas fa-user-bed"></i>Add New Appointment</a></li>
                    </div>
                    <li class="accordion"><a href="#"><i class="fas fa-user-plus"></i>Room Management</a></li>
                    <div class="panel">
                    <li><a href="secretary_view_rooms.php"><i class="fas fa-user-bed"></i>View Rooms</a></li>
                    </div>
                    <br>
                    <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i>Log out</a></li>
                  
                </ul>     
            </div>
           
        </div>
        <script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";//close one panel when another is opened
    } 
  });
}
</script>
