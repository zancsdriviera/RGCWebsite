
<?php $__env->startSection('title', 'About Us'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">About Us</h3>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <div class="row g-3 mb-4">
            <!-- ================= MISSION ================= -->
            <div class="col-md-6">
                <form action="<?php echo e(route('admin.about_us.update', 'mission')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card h-100">
                        <div class="card-header" style="font-weight: bold; font-size:1.2em">Mission Section</div>
                        <div class="card-body">
                            <div class="mb-2">
                                <label>Title</label>
                                <input type="text" name="mission_title" class="form-control"
                                    value="<?php echo e(old('mission_title', $aboutUsContent->mission_title ?? '')); ?>" required>
                            </div>
                            <div class="mb-2">
                                <label>Text</label>
                                <textarea name="mission_text" class="form-control" rows="5" required><?php echo e(old('mission_text', $aboutUsContent->mission_text ?? '')); ?></textarea>
                            </div>
                            <div class="mb-2">
                                <label>Image</label>
                                <input type="file" name="mission_image" class="form-control" required>
                                <?php if(!empty($aboutUsContent->mission_image)): ?>
                                    <img src="<?php echo e(Storage::url($aboutUsContent->mission_image)); ?>" class="img-fluid mt-2"
                                        style="max-height:150px;">
                                <?php endif; ?>
                            </div>
                            <button type="submit" class="btn btn-success w-100"><i
                                    class="bi bi-check2-square me-2"></i>Save</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- ================= VISION ================= -->
            <div class="col-md-6">
                <form action="<?php echo e(route('admin.about_us.update', 'vision')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card h-100">
                        <div class="card-header" style="font-weight: bold; font-size:1.2em">Vision Section</div>
                        <div class="card-body">
                            <div class="mb-2">
                                <label>Title</label>
                                <input type="text" name="vision_title" class="form-control"
                                    value="<?php echo e(old('vision_title', $aboutUsContent->vision_title ?? '')); ?>" required>
                            </div>
                            <div class="mb-2">
                                <label>Text</label>
                                <textarea name="vision_text" class="form-control" rows="5" required><?php echo e(old('vision_text', $aboutUsContent->vision_text ?? '')); ?></textarea>
                            </div>
                            <div class="mb-2">
                                <label>Image</label>
                                <input type="file" name="vision_image" class="form-control" required>
                                <?php if(!empty($aboutUsContent->vision_image)): ?>
                                    <img src="<?php echo e(Storage::url($aboutUsContent->vision_image)); ?>" class="img-fluid mt-2"
                                        style="max-height:150px;">
                                <?php endif; ?>
                            </div>
                            <button type="submit" class="btn btn-success w-100"><i
                                    class="bi bi-check2-square me-2"></i>Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="card mb-4">
            <div class="card-header" style="font-weight: bold; font-size:1.2em">Board of Directors</div>
            <div class="card-body">
                <!-- Save year -->
                <form action="<?php echo e(route('admin.about_us.update', 'boards')); ?>" method="POST" class="mb-3">
                    <?php echo csrf_field(); ?>
                    <div class="mb-2">
                        <label>Year</label>
                        <input type="text" name="board_year" class="form-control form-control-sm"
                            value="<?php echo e(old('board_year', $aboutUsContent->board_year ?? '')); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm"><i
                            class="bi bi-check2-square me-2"></i>Save</button>
                </form>

                <?php $boards = $aboutUsContent->boards ?? []; ?>

                <div class="row g-2" id="boardsContainer">
                    <?php $__currentLoopData = $boards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $board): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-6 col-sm-4 col-md-3 board-card">
                            <div class="border p-2 h-100">
                                <form action="<?php echo e(route('admin.about_us.update_board', $i)); ?>" method="POST"
                                    enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>

                                    <div class="mb-1">
                                        <input type="text" name="name" class="form-control form-control-sm"
                                            placeholder="Name" value="<?php echo e($board['name'] ?? ''); ?>" required>
                                    </div>

                                    <div class="mb-1">
                                        <input type="text" name="position" class="form-control form-control-sm"
                                            placeholder="Position" value="<?php echo e($board['position'] ?? ''); ?>" required>
                                    </div>

                                    <div class="mb-1">
                                        <input type="file" name="image" class="form-control form-control-sm"
                                            <?php echo e(empty($board['image']) ? 'required' : ''); ?>>

                                        <?php if(!empty($board['image'])): ?>
                                            <img src="<?php echo e(Storage::url($board['image'])); ?>" class="img-fluid mt-1"
                                                style="max-height:100px;">
                                        <?php endif; ?>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-sm w-100">Save</button>
                                </form>


                                <form action="<?php echo e(route('admin.about_us.remove_board', $i)); ?>" method="POST"
                                    class="mt-1">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-danger btn-sm w-100">Remove</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Add new (client-side) -->
                <button type="button" id="addBoardBtn" class="btn btn-primary mt-2"><i
                        class="bi bi-plus-circle me-2"></i>Add Board Member</button>
            </div>
        </div>


        <!-- ================= FACILITIES ================= -->
        <div class="card mb-4">
            <div class="card-header" style="font-weight: bold; font-size:1.2em">Facilities</div>
            <div class="card-body">
                <?php $bullets = $aboutUsContent->facilities_bullets ?? []; ?>

                <div class="row">
                    <!-- Left Column: Caption + Image + Save -->
                    <div class="col-md-6">
                        <form action="<?php echo e(route('admin.about_us.update', 'facilities')); ?>" method="POST"
                            enctype="multipart/form-data" class="mb-3">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label>Caption</label>
                                
                                <textarea name="facilities_caption" class="form-control" rows="5" required><?php echo e(old('facilities_caption', $aboutUsContent->facilities_caption ?? '')); ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label>Image</label>
                                <input type="file" name="facilities_image" class="form-control" required>
                                <?php if(!empty($aboutUsContent->facilities_image)): ?>
                                    <img src="<?php echo e(Storage::url($aboutUsContent->facilities_image)); ?>"
                                        class="img-fluid mt-2" style="max-height:150px;">
                                <?php endif; ?>
                            </div>
                            <button type="submit" class="btn btn-success"><i
                                    class="bi bi-check2-square me-2"></i>Save</button>
                        </form>
                    </div>

                    <!-- Right Column: Bullets (client-side Add, AJAX Save/Remove) -->
                    <div class="col-md-6">
                        <div id="bulletsList">
                            <?php $__currentLoopData = $bullets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $bullet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="d-flex mb-2 align-items-center server-bullet"
                                    data-index="<?php echo e($i); ?>">
                                    <input type="text" class="form-control me-2 server-bullet-input"
                                        value="<?php echo e($bullet); ?>">
                                    <button type="button" class="btn btn-danger btn-sm server-remove-btn"> <i
                                            class="bi bi-trash"></i>Remove</button>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <div class="mt-2">
                            <button type="button" id="addBulletBtn" class="btn btn-primary"> <i
                                    class="bi bi-plus-circle me-2"></i>Add Bullet</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= VALUES / CORE PRINCIPLES ================= -->
        <div class="card mb-4">
            <div class="card-header" style="font-weight: bold; font-size:1.2em">Values / Core Principles</div>
            <div class="card-body">
                <?php $values = $aboutUsContent->values ?? []; ?>

                <div class="row g-3" id="valuesContainer">
                    <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-12 col-sm-6 col-md-3 value-card" data-index="<?php echo e($i); ?>">
                            <form action="<?php echo e(route('admin.about_us.update_value', ['index' => $i])); ?>" method="POST"
                                enctype="multipart/form-data">

                                <?php echo csrf_field(); ?>
                                <div>
                                    <div class="mb-2">
                                        <label style="font-weight: bold">Title</label>
                                        <input type="text" name="title" class="form-control"
                                            value="<?php echo e($value['title'] ?? ''); ?>" required>
                                    </div>

                                    <div class="mb-2">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" rows="2" required><?php echo e($value['description'] ?? ''); ?></textarea>
                                    </div>

                                    <div class="mb-2">
                                        <label>Icon</label>
                                        <input type="file" name="icon" class="form-control"
                                            <?php if(empty($value['icon'])): ?> required <?php endif; ?>>

                                        <?php if(!empty($value['icon'])): ?>
                                            <img src="<?php echo e(Storage::url($value['icon'])); ?>" class="img-fluid mt-1"
                                                style="max-height:50px;">
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="mt-2 d-flex gap-2">
                                    <button type="submit" name="action" value="save"
                                        class="btn btn-primary w-50">Save</button>
                                    <button type="button" class="btn btn-danger w-50 removeValueBtn">Remove</button>
                                </div>
                            </form>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Add new (client-side) -->
                <button type="button" id="addValueBtn" class="btn btn-primary mt-3"><i
                        class="bi bi-plus-circle me-2"></i>Add Value</button>
            </div>
        </div>
    </div>
    <!-- Generic confirmation modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="confirmForm" class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmModalTitle">Confirm</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="confirmModalBody">Are you sure?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="confirmModalOkBtn"><i
                            class="bi bi-check2-square me-2"></i>Confirm</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header btn-success text-white">
                    <h5 class="modal-title">Success</h5>
                </div>
                <div class="modal-body text-black">
                    <?php echo e(session('modal_message')); ?>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Error</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-black" id="errorModalBody">
                    <!-- message injected here -->
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>


    <?php if(session('show_modal')): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let modalEl = document.getElementById('successModal');
                let modal = new bootstrap.Modal(modalEl);

                modal.show();

                // setTimeout(() => {
                //     modal.hide();
                // }, 2000); // 2 seconds
            });
        </script>
    <?php endif; ?>


    <script>
        const showConfirmModal = (title, message) => {
            return new Promise((resolve) => {
                const modalEl = document.getElementById('confirmModal');
                const modal = new bootstrap.Modal(modalEl);
                document.getElementById('confirmModalTitle').textContent = title;
                document.getElementById('confirmModalBody').textContent = message;

                const okBtn = document.getElementById('confirmModalOkBtn');

                const cleanup = () => {
                    okBtn.removeEventListener('click', onOk);
                    modal.hide();
                };

                const onOk = () => {
                    cleanup();
                    resolve(true);
                };

                okBtn.addEventListener('click', onOk);

                modal.show();
            });
        };

        function showSuccessModal(message, isError = false) {
            const modalEl = document.getElementById('successModal');
            const modalBody = modalEl.querySelector('.modal-body');

            modalBody.textContent = message;

            // optional: colorize error
            modalBody.style.color = isError ? 'red' : 'green';

            const modal = new bootstrap.Modal(modalEl);
            modal.show();

            // auto-close after 1.5 seconds
            setTimeout(() => modal.hide(), 2000);
        }

        function showErrorModal(message) {
            const modalEl = document.getElementById('errorModal');
            const modalBody = document.getElementById('errorModalBody');
            modalBody.textContent = message || 'An error occurred';
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }


        document.addEventListener('DOMContentLoaded', function() {
            const addBtn = document.getElementById('addBoardBtn');
            const boardsContainer = document.getElementById('boardsContainer');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Routes rendered by Blade; __IDX__ replaced later
            const addUrl =
                "<?php echo e(route('admin.about_us.add_board')); ?>"; // POST -> returns { success: true, index: N }
            const updateUrlTemplate = "<?php echo e(route('admin.about_us.update_board', ['index' => '__IDX__'])); ?>"; // POST
            const removeUrlTemplate = "<?php echo e(route('admin.about_us.remove_board', ['index' => '__IDX__'])); ?>"; // POST
            const storageBase = "<?php echo e(asset('storage')); ?>"; // for previewing saved image

            // Helper to build a server-backed card element (index + board data)
            function buildServerCard(index, board) {
                const col = document.createElement('div');
                col.className = 'col-6 col-sm-4 col-md-3 board-card';
                const imageHtml = board.image ?
                    `<img src="${storageBase}/${board.image}" class="img-fluid mt-1" style="max-height:100px;">` :
                    '';
                const updateAction = updateUrlTemplate.replace('__IDX__', index);
                const removeAction = removeUrlTemplate.replace('__IDX__', index);

                col.innerHTML = `
            <div class="border p-2 h-100">
                <form action="${updateAction}" method="POST" enctype="multipart/form-data" class="server-update-form">
                    <input type="hidden" name="_token" value="${csrfToken}">
                    <div class="mb-1">
                        <input type="text" name="name" class="form-control form-control-sm" placeholder="Name" value="${escapeHtml(board.name || '')}">
                    </div>
                    <div class="mb-1">
                        <input type="text" name="position" class="form-control form-control-sm" placeholder="Position" value="${escapeHtml(board.position || '')}">
                    </div>
                    <div class="mb-1">
                        <input type="file" name="image" class="form-control form-control-sm">
                        <div class="preview-wrap">${imageHtml}</div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm w-100">Save</button>
                </form>

                <button type="button" class="btn btn-danger btn-sm w-100 mt-1 server-remove-btn">Remove</button>
            </div>
        `;

                // wire handlers for Save (AJAX) and Remove (AJAX) on this server-backed card
                const updateForm = col.querySelector('.server-update-form');
                updateForm.addEventListener('submit', async function(ev) {
                    ev.preventDefault();
                    const formData = new FormData(this);
                    // POST to update (server expects index in URL)
                    try {
                        const resp = await fetch(this.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: formData
                        });

                        const json = await resp.json();

                        if (json.success) {
                            if (json.board && json.board.image) {
                                const previewWrap = updateForm.querySelector('.preview-wrap');
                                previewWrap.innerHTML =
                                    `<img src="${storageBase}/${json.board.image}" class="img-fluid mt-1" style="max-height:100px;">`;
                            }
                            showSuccessModal('Board member saved successfully!');
                        } else {
                            showErrorModal(json.message || 'Save failed');
                        }
                    } catch (err) {
                        if (err.response && err.response.status === 422) {
                            const errors = await err.response.json();
                            // Combine all validation messages
                            const messages = Object.values(errors.errors).flat().join('\n');
                            showErrorModal(messages);
                        } else {
                            console.error(err);
                            showErrorModal('Save error');
                        }
                    }
                });

                const remBtn = col.querySelector('.server-remove-btn');
                remBtn.addEventListener('click', async () => {
                    const confirmed = await showConfirmModal('Remove Board Member?',
                        'Are you sure you want to remove this board member?');
                    if (!confirmed) return;
                    const url = removeAction;
                    try {
                        const resp = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            }
                        });
                        const json = await resp.json();
                        if (json.success) {
                            col.remove();
                        } else {
                            alert(json.message || 'Remove failed');
                        }
                    } catch (err) {
                        console.error(err);
                        alert('Remove error');
                    }
                });

                return col;
            }

            // Helper to build a local (unsaved) card element (Save => create server entry + update)
            function buildLocalCard() {
                const col = document.createElement('div');
                col.className = 'col-6 col-sm-4 col-md-3 board-card';
                col.innerHTML = `
            <div class="border p-2 h-100">
                <div class="mb-1">
                    <input type="text" name="name" class="form-control form-control-sm local-name" placeholder="Name" value="">
                </div>
                <div class="mb-1">
                    <input type="text" name="position" class="form-control form-control-sm local-position" placeholder="Position" value="">
                </div>
                <div class="mb-1">
                    <input type="file" name="image" class="form-control form-control-sm local-image">
                    <div class="preview-wrap"></div>
                </div>
                <div class="d-grid gap-1">
                    <button type="button" class="btn btn-success btn-sm local-save-btn">Save</button>
                    <button type="button" class="btn btn-secondary btn-sm local-cancel-btn">Cancel</button>
                </div>
            </div>
        `;

                // Cancel removes local card
                col.querySelector('.local-cancel-btn').addEventListener('click', function() {
                    col.remove();
                });

                // Save: 2-step -> create server placeholder (addBoard) then updateBoard(index) with formData
                col.querySelector('.local-save-btn').addEventListener('click', async function() {
                    const name = col.querySelector('.local-name').value.trim();
                    const position = col.querySelector('.local-position').value.trim();
                    const fileInput = col.querySelector('.local-image');
                    if (!name && !position && fileInput.files.length === 0) {
                        await showConfirmModal('Missing Data',
                            'Please provide name, position, or choose an image before saving.');
                        return;
                    }


                    try {
                        // Step 1: create placeholder on server to obtain index
                        const addResp = await fetch(addUrl, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            }
                        });
                        const addJson = await addResp.json();
                        if (!addJson.success || typeof addJson.index === 'undefined') {
                            alert('Server failed to create new board entry.');
                            return;
                        }
                        const newIndex = addJson.index;
                        const updateUrl = updateUrlTemplate.replace('__IDX__', newIndex);

                        // Step 2: send FormData to updateBoard(index)
                        const fd = new FormData();
                        fd.append('name', name);
                        fd.append('position', position);
                        if (fileInput.files.length > 0) fd.append('image', fileInput.files[0]);

                        const updResp = await fetch(updateUrl, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: fd
                        });
                        const updJson = await updResp.json();
                        if (!updJson.success) {
                            alert(updJson.message || 'Failed to save board member.');
                            return;
                        }

                        // Step 3: replace local card with server-backed card using returned board data (if provided)
                        const serverCard = buildServerCard(newIndex, updJson.board || {
                            name,
                            position,
                            image: ''
                        });
                        col.replaceWith(serverCard);
                        serverCard.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    } catch (err) {
                        console.error(err);
                        alert('Network error while saving board member.');
                    }
                });

                return col;
            }

            // small helper to escape text
            function escapeHtml(str) {
                if (!str) return '';
                return String(str)
                    .replace(/&/g, '&amp;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;');
            }

            // Initialize: convert any existing server-rendered cards into JS-handled server cards
            (function initServerCards() {
                // find existing server cards produced by blade
                const serverCols = Array.from(boardsContainer.querySelectorAll('.board-card'));
                serverCols.forEach((col, idx) => {
                    // gather data from existing inputs and preview
                    const nameInput = col.querySelector('input[name="name"]');
                    const posInput = col.querySelector('input[name="position"]');
                    const previewImg = col.querySelector('img');
                    const name = nameInput ? nameInput.value : '';
                    const position = posInput ? posInput.value : '';
                    const imagePath = previewImg ? previewImg.getAttribute('src').replace(/^\/?/, '')
                        .replace(/^storage\//, '') : '';
                    // build a fresh server-side card (clean handlers), replace old col
                    const serverCard = buildServerCard(idx, {
                        name,
                        position,
                        image: imagePath
                    });
                    col.replaceWith(serverCard);
                });
            })();

            // Add button: insert a local (unsaved) card instantly (no server call)
            addBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const local = buildLocalCard();
                boardsContainer.appendChild(local);
                local.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            });
        });

        //Facilities Bullets - Remove (server-side)
        document.addEventListener('DOMContentLoaded', function() {
            const bulletsList = document.getElementById('bulletsList');
            const addBtn = document.getElementById('addBulletBtn');
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                '<?php echo e(csrf_token()); ?>';

            // route templates
            const addUrl = "<?php echo e(route('admin.about_us.add_bullet')); ?>"; // POST
            const updateUrlTemplate =
                "<?php echo e(route('admin.about_us.update_bullet', ['index' => '__IDX__'])); ?>"; // POST
            const removeUrlTemplate =
                "<?php echo e(route('admin.about_us.remove_bullet', ['index' => '__IDX__'])); ?>"; // POST

            // create a client-only bullet row (unsaved)
            function createLocalRow() {
                const container = document.createElement('div');
                container.className = 'd-flex mb-2 align-items-center local-bullet';
                container.innerHTML = `
            <input type="text" class="form-control me-2 local-bullet-input" placeholder="Bullet text">
            <button type="button" class="btn btn-success btn-sm me-1 local-save-btn">Save</button>
            <button type="button" class="btn btn-secondary btn-sm local-cancel-btn">Cancel</button>
        `;
                // events: save/cancel
                container.querySelector('.local-cancel-btn').addEventListener('click', () => container.remove());

                container.querySelector('.local-save-btn').addEventListener('click', async () => {
                    const input = container.querySelector('.local-bullet-input');
                    const text = input.value.trim();
                    if (!text) {
                        await showConfirmModal('Missing Data', 'Bullet cannot be empty!');
                        return;
                    }

                    try {
                        // 1) create server-side blank bullet -> returns index
                        const addResp = await fetch(addUrl, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            }
                        });
                        const addJson = await addResp.json();
                        if (!addJson.success) throw new Error('Failed to create bullet on server');

                        const newIndex = addJson.index;
                        // 2) update that new index with the bullet text
                        const updateUrl = updateUrlTemplate.replace('__IDX__', newIndex);
                        const formData = new FormData();
                        formData.append('bullet', text);
                        formData.append('action', 'save');

                        const updResp = await fetch(updateUrl, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: formData
                        });
                        const updJson = await updResp.json();
                        if (!updJson.success) throw new Error('Failed to save bullet text');

                        // 3) replace local row with server-backed row
                        const serverRow = document.createElement('div');
                        serverRow.className = 'd-flex mb-2 align-items-center server-bullet';
                        serverRow.setAttribute('data-index', newIndex);
                        serverRow.innerHTML = `
                    <input type="text" class="form-control me-2 server-bullet-input" value="${escapeHtml(text)}">
                    <button type="button" class="btn btn-danger btn-sm server-remove-btn">Remove</button>
                `;
                        // replace
                        container.replaceWith(serverRow);
                        attachServerRowHandlers(serverRow);
                    } catch (err) {
                        console.error(err);
                        alert('Could not save bullet. See console for details.');
                    }
                });

                bulletsList.appendChild(container);
                container.querySelector('.local-bullet-input').focus();
            }

            // attach remove handler to server-backed row element
            function attachServerRowHandlers(row) {
                const removeBtn = row.querySelector('.server-remove-btn');
                const input = row.querySelector('.server-bullet-input');

                removeBtn.addEventListener('click', async () => {
                    const confirmed = await showConfirmModal('Remove Bullet?',
                        'Are you sure you want to remove this facility bullet?');
                    if (!confirmed) return;
                    const idx = row.getAttribute('data-index');
                    const url = removeUrlTemplate.replace('__IDX__', idx);

                    try {
                        const resp = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            }
                        });
                        const json = await resp.json();
                        if (json.success) {
                            row.remove();
                            // Optionally: you might want to refresh server-side indexes or reload bullets area
                        } else {
                            alert(json.message || 'Failed to remove bullet');
                        }
                    } catch (err) {
                        console.error(err);
                        alert('Remove failed');
                    }
                });

                // Optional: allow inline saving edits for existing server-backed bullets without page reload:
                input.addEventListener('blur', async () => {
                    const newText = input.value.trim();
                    const idx = row.getAttribute('data-index');
                    if (newText === '') {
                        alert('Bullet cannot be empty');
                        return;
                    }
                    // POST update
                    const url = updateUrlTemplate.replace('__IDX__', idx);
                    const formData = new FormData();
                    formData.append('bullet', newText);
                    formData.append('action', 'save');

                    try {
                        const resp = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: formData
                        });
                        const json = await resp.json();
                        if (!json.success) {
                            alert(json.message || 'Save failed');
                        }
                    } catch (err) {
                        console.error(err);
                        alert('Save failed');
                    }
                });
            }

            // escape helper
            function escapeHtml(str) {
                return String(str).replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/'/g, '&#039;')
                    .replace(/</g, '&lt;').replace(/>/g, '&gt;');
            }

            // initialize existing server rows
            document.querySelectorAll('#bulletsList .server-bullet').forEach(row => attachServerRowHandlers(row));

            // wire Add button
            addBtn.addEventListener('click', function() {
                createLocalRow();
            });
        });

        // Values / Core Principles - Add, Update, Remove (AJAX)

        document.addEventListener('DOMContentLoaded', function() {
            const addBtn = document.getElementById('addValueBtn');
            const valuesContainer = document.getElementById('valuesContainer');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const addUrl = "<?php echo e(route('admin.about_us.add_value')); ?>";
            const updateUrlTemplate = "<?php echo e(route('admin.about_us.update_value', ['index' => '__IDX__'])); ?>";
            const removeUrlTemplate = "<?php echo e(route('admin.about_us.remove_value', ['index' => '__IDX__'])); ?>";
            const storageBase = "<?php echo e(asset('storage')); ?>";

            function escapeHtml(str) {
                if (!str) return '';
                return String(str).replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/'/g, '&#039;')
                    .replace(/</g, '&lt;').replace(/>/g, '&gt;');
            }

            function buildServerCard(index, value) {
                const col = document.createElement('div');
                col.className = 'col-12 col-sm-6 col-md-3 value-card';
                const imgHtml = value.icon ?
                    `<img src="${storageBase}/${value.icon}" class="img-fluid mt-1" style="max-height:50px;">` : '';
                const updateAction = updateUrlTemplate.replace('__IDX__', index);
                const removeAction = removeUrlTemplate.replace('__IDX__', index);

                col.innerHTML = `
            <div class="border p-2 h-100">
                <form action="${updateAction}" method="POST" enctype="multipart/form-data" class="server-update-form">
                    <input type="hidden" name="_token" value="${csrfToken}">
                    <div class="mb-2">
                        <input type="text" name="title" class="form-control" placeholder="Title" value="${escapeHtml(value.title || '')}">
                    </div>
                    <div class="mb-2">
                        <textarea name="description" class="form-control" rows="2" placeholder="Description">${escapeHtml(value.description || '')}</textarea>
                    </div>
                    <div class="mb-2">
                        <input type="file" name="icon" class="form-control">
                        <div class="preview-wrap">${imgHtml}</div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Save</button>
                </form>
                <button type="button" class="btn btn-danger w-100 mt-1 server-remove-btn">Remove</button>
            </div>
        `;

                col.querySelector('.server-update-form').addEventListener('submit', async function(e) {
                    e.preventDefault();
                    const fd = new FormData(this);

                    try {
                        const resp = await fetch(this.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: fd
                        });

                        // 1. HTTP status must be 2xx
                        if (!resp.ok) {
                            let msg = 'Save failed (server error)';
                            const ct = resp.headers.get('content-type') || '';

                            if (ct.includes('application/json')) {
                                try {
                                    const errJson = await resp.json();
                                    msg = errJson.message || msg;
                                } catch {}
                            }

                            showErrorModal(msg, true);
                            return;
                        }

                        // 2. Must return JSON
                        const ct = resp.headers.get('content-type') || '';
                        if (!ct.includes('application/json')) {
                            showSuccessModal('Unexpected server response', true);
                            return;
                        }

                        const json = await resp.json();

                        // 3. Success = true
                        if (json.success) {
                            if (json.value && json.value.icon) {
                                const previewWrap = this.querySelector('.preview-wrap');
                                if (previewWrap) {
                                    previewWrap.innerHTML =
                                        `<img src="${storageBase}/${json.value.icon}" class="img-fluid mt-1" style="max-height:50px;">`;
                                }
                            }

                            showSuccessModal('Principles saved successfully!');
                            return;
                        }

                        // 4. Server returned success:false
                        showErrorModal(json.message || 'Save failed', true);

                    } catch (err) {
                        console.error(err);
                        showErrorModal('Network error while saving', true);
                    }
                });

                col.querySelector('.server-remove-btn').addEventListener('click', async function() {
                    const confirmed = await showConfirmModal('Remove Value / Core Principle?',
                        'Are you sure you want to remove this entry?');
                    if (!confirmed) return;
                    try {
                        const resp = await fetch(removeAction, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            }
                        });
                        const json = await resp.json();
                        if (json.success) col.remove();
                        else alert(json.message || 'Remove failed');
                    } catch (err) {
                        console.error(err);
                        alert('Remove failed');
                    }
                });

                return col;
            }

            function buildLocalCard() {
                const col = document.createElement('div');
                col.className = 'col-12 col-sm-6 col-md-3 value-card';
                col.innerHTML = `
            <div class="border p-2 h-100">
                <div class="mb-2">
                    <input type="text" class="form-control local-title" placeholder="Title">
                </div>
                <div class="mb-2">
                    <textarea class="form-control local-desc" rows="2" placeholder="Description"></textarea>
                </div>
                <div class="mb-2">
                    <input type="file" class="form-control local-icon">
                    <div class="preview-wrap"></div>
                </div>
                <div class="d-grid gap-1">
                    <button type="button" class="btn btn-success btn-sm local-save-btn">Save</button>
                    <button type="button" class="btn btn-secondary btn-sm local-cancel-btn">Cancel</button>
                </div>
            </div>
        `;

                // Cancel removes card
                col.querySelector('.local-cancel-btn').addEventListener('click', () => col.remove());

                // Save: create placeholder then update
                col.querySelector('.local-save-btn').addEventListener('click', async function() {
                    const title = col.querySelector('.local-title').value.trim();
                    const desc = col.querySelector('.local-desc').value.trim();
                    const fileInput = col.querySelector('.local-icon');
                    if (!title && !desc && fileInput.files.length === 0) {
                        await showConfirmModal('Missing Data', 'Provide data before saving!');
                        return;
                    }

                    try {
                        // Step1: create placeholder
                        const addResp = await fetch(addUrl, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            }
                        });
                        const addJson = await addResp.json();
                        if (!addJson.success || typeof addJson.index === 'undefined') {
                            alert('Server failed');
                            return;
                        }
                        const newIndex = addJson.index;
                        const updateUrl = updateUrlTemplate.replace('__IDX__', newIndex);

                        // Step2: send formData
                        const fd = new FormData();
                        fd.append('title', title);
                        fd.append('description', desc);
                        if (fileInput.files.length > 0) fd.append('icon', fileInput.files[0]);

                        const updResp = await fetch(updateUrl, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: fd
                        });
                        const updJson = await updResp.json();
                        if (!updJson.success) {
                            alert(updJson.message || 'Save failed');
                            return;
                        }

                        // Step3: replace local card with server card
                        const serverCard = buildServerCard(newIndex, updJson.value || {
                            title,
                            description,
                            icon: ''
                        });
                        col.replaceWith(serverCard);
                        serverCard.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    } catch (err) {
                        console.error(err);
                        alert('Network error');
                    }
                });

                // Icon preview
                col.querySelector('.local-icon').addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const preview = col.querySelector('.preview-wrap');
                        preview.innerHTML =
                            `<img src="${URL.createObjectURL(file)}" class="img-fluid mt-1" style="max-height:50px;">`;
                    }
                });

                return col;
            }

            // Initialize existing server-rendered cards
            (function initServerCards() {
                const serverCols = Array.from(valuesContainer.querySelectorAll('.value-card'));
                serverCols.forEach((col, idx) => {
                    const title = col.querySelector('input[name="title"]').value || '';
                    const desc = col.querySelector('textarea[name="description"]').value || '';
                    const imgEl = col.querySelector('img');
                    const iconPath = imgEl ? imgEl.getAttribute('src').replace(/^\/?/, '').replace(
                        /^storage\//, '') : '';
                    const serverCard = buildServerCard(idx, {
                        title,
                        description: desc,
                        icon: iconPath
                    });
                    col.replaceWith(serverCard);
                });
            })();

            addBtn.addEventListener('click', () => {
                const local = buildLocalCard();
                valuesContainer.appendChild(local);
                local.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/admin_about_us.blade.php ENDPATH**/ ?>