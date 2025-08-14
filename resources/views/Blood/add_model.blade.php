<form action="/" method="POST" id="bloodForm">
    @csrf

    <div class="mb-3">
        <label for="orgName" class="form-label">Organization Name</label>
        <input type="text" class="form-control" id="orgName" name="orgName" required>
    </div>

    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" class="form-control" id="date" name="date" required>
    </div>

    <div class="mb-3">
        <label for="place" class="form-label">Place</label>
        <input type="text" class="form-control" id="place" name="place" required>
    </div>

    <div class="mb-3">
        <label for="bloodBank" class="form-label">Blood Bank Name</label>
        <input type="text" class="form-control" id="bloodBank" name="bloodBank" required>
    </div>
</form>
