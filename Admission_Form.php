<?php include('Crystalline_navbar.php');?>
<body>

<div class="container mt-5">
  <form id="registrationForm" method="post" action="submit.php" enctype="multipart/form-data">
    <div class="row mb-3">
      <div class="col-md-6">
        <label for="firstname" class="form-label">First Name</label>
        <input type="text" class="form-control" id="firstname" name="firstname" required>
      </div>
      <div class="col-md-6">
        <label for="lastname" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="lastname" name="lastname" required>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-6">
        <label for="gender" class="form-label">Gender</label>
        <select class="form-select" id="gender" name="gender" required>
          <option value="">Select Gender</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
      </div>
      <div class="col-md-6">
        <label for="birthday" class="form-label">Birthday</label>
        <input type="date" class="form-control" id="birthday" name="birthday" required>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-6">
        <label for="contact" class="form-label">Contact Number</label>
        <input type="tel" class="form-control" id="contact" name="contact" required>
      </div>
      <div class="col-md-6">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
    </div>
    <div class="mb-3">
      <label for="address" class="form-label">Residential Address</label>
      <input type="text" class="form-control" id="address" name="address" required>
    </div>
    <div class="row mb-3">
      <div class="col-md-6">
        <label for="state" class="form-label">State of Origin</label>
        <input type="text" class="form-control" id="state" name="state" required>
      </div>
      <div class="col-md-6">
        <label for="birthplace" class="form-label">Place of Birth</label>
        <input type="text" class="form-control" id="birthplace" name="birthplace" required>
      </div>
    </div>
    <div class="mb-3">
      <label for="parentOccupation" class="form-label">Occupation of Parent</label>
      <input type="text" class="form-control" id="parentOccupation" name="parentOccupation" required>
    </div>
    <div class="mb-3">
      <label for="picture" class="form-label">Picture</label>
      <input type="file" class="form-control" id="picture" name="picture" accept="image/*" required>
    </div>
    <div class="row mb-3">
      <div class="col-md-6">
        <label for="bloodGroup" class="form-label">Blood Genotype</label>
        <input type="text" class="form-control" id="bloodGroup" name="bloodGroup" required>
      </div>
      <div class="col-md-6">
        <label for="healthChallenges" class="form-label">Health Challenges</label>
        <input type="text" class="form-control" id="healthChallenges" name="healthChallenges">
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-6">
        <label for="currentClass" class="form-label">Current Class</label>
        <input type="text" class="form-control" id="currentClass" name="currentClass" required>
      </div>
      <div class="col-md-6">
        <label for="anticipatedClass" class="form-label">Anticipated Class</label>
        <input type="text" class="form-control" id="anticipatedClass" name="anticipatedClass" required>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-6">
        <label for="nextOfKin" class="form-label">Next of Kin</label>
        <input type="text" class="form-control" id="nextOfKin" name="nextOfKin" required>
      </div>
    </div>
    <div class="mb-3">
      <label for="questions" class="form-label">Questions</label>
      <textarea class="form-control" id="questions" name="questions" rows="4"></textarea>
    </div>
    <div class="row">
      <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </form>
</div>

<!-- Include Bootstrap JS and jQuery -->

</body>
</html>
<?php include('Crystalline_footer.php');?>
