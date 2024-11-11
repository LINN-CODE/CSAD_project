<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job CV Submission Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: url(./restaurant2.jpg) no-repeat center;
            background-size: cover;
            width: 100%;
            height: 100vh;
            padding: 30px;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            margin-bottom: 20px;
        }
        .btn {
            background: #cf2906;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2 class="text-center">Job CV Submission</h2>
    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-info">
            <?php echo htmlspecialchars($_GET['msg']); ?>
        </div>
    <?php endif; ?>
    <form action="submit_cv.php" method="post" enctype="multipart/form-data" id="cvForm">
        <div class="form-group">
            <label for="name">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="role">Role <span class="text-danger">*</span></label>
            <select class="form-control" id="role" name="role" required>
                <option value="" disabled selected>Select the role you are applying for</option>
                <option value="service_crew">Service Crew</option>
                <option value="barista">Barista</option>
                <option value="manager">Manager</option>
                <option value="rider">Rider</option>
            </select>
        </div>
        <div class="form-group">
            <label for="cv">Upload CV (PDF) <span class="text-danger">*</span></label>
            <input type="file" class="form-control-file" id="cv" name="cv" accept=".pdf" required>
        </div>
        <button type="submit" class="btn btn-block">Submit</button>
        <a href="index.php" class="btn btn-block">Return to Home</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    function validateForm() {
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const role = document.getElementById('role').value;
        const regex = /<(.|\n)*?>/g;

        if (regex.test(name) || regex.test(email) || regex.test(role)) {
            alert('HTML content is not allowed in the form inputs.');
            return false;
        }

        return true;
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('cvForm').onsubmit = validateForm;
    });
</script>
</body>
</html>
