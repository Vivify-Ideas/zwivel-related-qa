<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       www.example.com
 * @since      1.0.0
 *
 * @package    Zwivel_Related_Qa
 * @subpackage Zwivel_Related_Qa/public/partials
 */
?>

<?php if (!empty($threads)) : ?>
    <div class="patient_questions">
        <div class="patient_questions_header">
            <h2>Questions & Answers</h2>
            <p>Patients ask » Doctors answer</p>
        </div>

        <?php foreach ($threads as $thread ) : ?>
            <div class="question_item">
                <a href="https://www.zwivel.com/forum/general-discussions/ask-cosmetic-doctor/<?php print $thread->slug ?>"><?php print $thread->title ?></a>
                <span><?php print $thread->post_count ?> doctor answers</span>
            </div>
        <?php endforeach; ?>

        <div class="patient_questions_header" style="margin-top:20px;">
            <h2>What's Your Question?</h2>
            <p>With thousands of doctor answers and counting, our forum is the best place to get expert opinions on cosmetic treatments.</p>
        </div>

        <?php if ($noMatchingTags) { ?>
            <div class="ask_your_own">
                <a href="https://www.zwivel.com/forum/general-discussions/ask-cosmetic-doctor/thread/create">Ask a Cosmetic Doctor on Zwivel</a>
                <a href="https://www.zwivel.com/forum/general-discussions/ask-cosmetic-doctor/">» View All Questions</a>
            </div>
        <?php } else { ?>
            <div class="ask_your_own">
                <a href="https://www.zwivel.com/forum/general-discussions/ask-cosmetic-doctor/thread/create?passed_category_id=<?php print $thread->typed_parent_category->id ?>">Ask a Cosmetic Doctor on Zwivel</a>
                <a href="https://www.zwivel.com/<?php print $thread->typed_parent_category->slug ?>/ask-a-doctor">» View All Questions</a>
            </div>
        <?php } ?>
    </div>
<?php endif; ?>