<?php require APPROOT . "/views/includes/header.php"; ?>
    <a href="<?php echo URLROOT; ?>/posts" class="btn btn-light">
        <i class="fa fa-backward"></i>
        Back
    </a>
    <div class="card card-body bg-light mt-5">
        <h2>Edit Post</h2>
        <p>Edit your post</p>
        <form action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['id']; ?>" method="POST">
            <div class="form-group">
                <label for="title">Title: <sup>*</sup></label>
                <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['titleError'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
                <span class="invalid-feedback"><?php echo $data['titleError']; ?></span>
            </div>
            <div class="form-group">
                <label for="body">body: <sup>*</sup></label>
                <textarea name="body" class="form-control form-control-lg <?php echo (!empty($data['bodyError'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['body']; ?>"><?php echo $data['body']; ?></textarea>
                <span class="invalid-feedback"><?php echo $data['bodyError']; ?></span>
            </div>
            <input type="submit" value="Submit" class="btn btn-success">
        </form>
    </div>
<?php require APPROOT . "/views/includes/footer.php"; ?>