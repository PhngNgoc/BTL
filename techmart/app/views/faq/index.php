<!-- app/views/faq/index.php -->

<div class="container py-4">
    <!-- Breadcrumb nhỏ -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="<?= BASE_URL ?>index.php?url=home/index">Trang chủ</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Hỏi &amp; Đáp</li>
        </ol>
    </nav>

    <!-- Tiêu đề -->
    <div class="d-flex align-items-center mb-3">
        <h1 class="h3 mb-0 me-3">Hỏi &amp; Đáp</h1>
        <span class="text-muted small">Những câu hỏi thường gặp từ khách hàng</span>
    </div>

    <hr class="mb-4">

    <?php if (!empty($faqs)): ?>
        <!-- Accordion Bootstrap 5 -->
        <div class="accordion accordion-flush" id="faqAccordion">
            <?php foreach ($faqs as $index => $item): ?>
                <?php
                    $headingId = 'headingFaq' . $index;
                    $collapseId = 'collapseFaq' . $index;
                ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="<?= $headingId ?>">
                        <button class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#<?= $collapseId ?>"
                                aria-expanded="false"
                                aria-controls="<?= $collapseId ?>">
                            <?= htmlspecialchars($item['question']) ?>
                        </button>
                    </h2>
                    <div id="<?= $collapseId ?>"
                         class="accordion-collapse collapse"
                         aria-labelledby="<?= $headingId ?>"
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <?= nl2br(htmlspecialchars($item['answer'])) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <!-- Trường hợp chưa có FAQ nào -->
        <div class="alert alert-info">
            Hiện chưa có câu hỏi nào. Vui lòng quay lại sau hoặc
            <a href="<?= BASE_URL ?>index.php?url=contact/index" class="alert-link">liên hệ với chúng tôi</a>
            để được hỗ trợ trực tiếp.
        </div>
    <?php endif; ?>
</div>
