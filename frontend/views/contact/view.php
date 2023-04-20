<!-- site__body -->
<div class="site__body">
    <div class="page-header">
        <div class="page-header__container container">
            <div class="page-header__breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="">Breadcrumb</a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Зв'язок з нами</li>
                    </ol>
                </nav>
            </div>
            <div class="page-header__title">
                <h1>Зв'язок з нами</h1>
            </div>
        </div>
    </div>
    <div class="block">
        <div class="container">
            <div class="card mb-0 contact-us">
                <div class="card-body">
                    <div class="contact-us__container">
                        <div class="row">
                            <div class="col-12 col-lg-6 pb-4 pb-lg-0">
                                <h4 class="contact-us__header card-title">Наша адреса</h4>
                                <div class="contact-us__address">
                                    <p>
                                        <?= $contacts->address?><br>
                                        Email: <?= $contacts->email?><br>
                                        Телефон: <?= $contacts->tel_primary ?>
                                                 <?= $contacts->tel_second ?>
                                    </p>
                                    <p>
                                        <strong>Години роботи</strong><br>
                                        <?= $contacts->hours_work ?>
                                    </p>
                                    <p>
                                        <?= $contacts->coments ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <h4 class="contact-us__header card-title">Leave us a Message</h4>
                                <form>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="form-name">Your Name</label>
                                            <input type="text" id="form-name" class="form-control" placeholder="Your Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="form-email">Email</label>
                                            <input type="email" id="form-email" class="form-control" placeholder="Email Address">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="form-subject">Subject</label>
                                        <input type="text" id="form-subject" class="form-control" placeholder="Subject">
                                    </div>
                                    <div class="form-group">
                                        <label for="form-message">Message</label>
                                        <textarea id="form-message" class="form-control" rows="4"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Send Message</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- site__body / end -->