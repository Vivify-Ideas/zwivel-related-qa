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

        <?php foreach ($threads as $key => $thread ) : ?>
            <div class="question_item">
                <a href="https://www.zwivel.com/forum/general-discussions/ask-cosmetic-doctor/<?php print $thread->slug ?>"><?php print $thread->title ?></a>

                <?php
                    // get first item in foreach
                    reset($threads);
                    if ($key === key($threads)) :
                ?>
                    <div class="first-thread-top-rated-answer">
                        <div class="first-thread-top-rated-answer-author">
                            <a class="media" href="https://www.zwivel.com/doctor/<?php print $thread->top_rated_post_by_doctor->author->doctor->slug; ?>">
                                <div class="media-object">
                                    <img src="https://www.zwivel.com/avatar/<?php print $thread->top_rated_post_by_doctor->author->id; ?>" >
                                </div>
                                <div class="media-body">
                                    <h5 class="media-title">
                                        Dr. <?php print $thread->top_rated_post_by_doctor->author->full_name ?>
                                    </h5>

                                    <?php if (!empty($thread->top_rated_post_by_doctor->author->doctor->certificates)) : ?>
                                        <small><?php print implode(', ', array_column($thread->top_rated_post_by_doctor->author->doctor->certificates, 'name')) ?></small>
                                    <?php else : ?>
                                        <small><?php print $thread->top_rated_post_by_doctor->author->doctor->clinics[0]->city ?>, </small>
                                        <small><?php print $thread->top_rated_post_by_doctor->author->doctor->clinics[0]->state ?></small>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>

                        <div class="first-thread-top-rated-answer-text" data-text="<?php print str_replace('"', "'", strip_tags($thread->top_rated_post_by_doctor->content)); ?>"></div>
                        <?php if ($thread->post_count > 2) : ?>
                            <div class="first-thread-top-rated-answer-other-doctors">
                                <p>
                                    <strong><?php print $thread->post_count - 1; ?> other doctors replied to this patient's request</strong>
                                </p>

                                <div class="first-thread-top-rated-answer-other-doctors-avatars">
                                    <?php for ($i = 1; $i < 5; $i++) : ?>
                                        <img src="https://www.zwivel.com/avatar/<?php print $thread->top_level_posts[$i]->author_id; ?>" >
                                    <?php endfor; ?>
                                    <span class="number-tag">+ <?php print count($thread->top_level_posts) - 4 ?></span>
                                </div>
                                <a class="btn btn-primary" href="https://www.zwivel.com/forum/general-discussions/ask-cosmetic-doctor/<?php print $thread->slug ?>">View all</a>
                            </div>
                        <?php elseif ($thread->post_count == 2) : ?>
                            <a href="https://www.zwivel.com/forum/general-discussions/ask-cosmetic-doctor/<?php print $thread->slug ?>">View Answer</a>
                        <?php else : ?>
                            <a href="https://www.zwivel.com/forum/general-discussions/ask-cosmetic-doctor/<?php print $thread->slug ?>">View Question</a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if ($key !== key($threads)) : ?>
                    <span><?php print $thread->post_count ?> doctor answers</span>
                <?php endif; ?>
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