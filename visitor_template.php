<?php
/**
 * @Created by          : Waris Agung Widodo (ido.alit@gmail.com)
 * @Date                : 2020-01-03 08:49
 * @File name           : visitor_template.php
 */

$main_template_path = __DIR__ . '/login_template.inc.php';

// set default language
if (isset($_GET['select_lang'])) {
    $select_lang = trim(strip_tags($_GET['select_lang']));
    // delete previous language cookie
    if (isset($_COOKIE['select_lang'])) {
        #@setcookie('select_lang', $select_lang, time()-14400, SWB);
        #@setcookie('select_lang', $select_lang, time()-14400, SWB, "", FALSE, TRUE);

        @setcookie('select_lang', $select_lang, [
            'expires' => time()-14400,
            'path' => SWB,
            'domain' => '',
            'secure' => false,
            'httponly' => true,
            'samesite' => 'Lax',
        ]);



    }
    // create language cookie
    #@setcookie('select_lang', $select_lang, time()+14400, SWB);
    #@setcookie('select_lang', $select_lang, time()+14400, SWB, "", FALSE, TRUE);

    @setcookie('select_lang', $select_lang, [
        'expires' => time()+14400,
        'path' => SWB,
        'domain' => '',
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);



    $sysconf['default_lang'] = $select_lang;
} else if (isset($_COOKIE['select_lang'])) {
    $sysconf['default_lang'] = trim(strip_tags($_COOKIE['select_lang']));
}

?>
<?php
    // Visit Year
    $visityear = $dbs->query('SELECT COUNT(visitor_id)FROM visitor_count WHERE YEAR(checkin_date) = YEAR(now())'); 
    $visityear = $visityear->fetch_row();
    // Visit Month
    $visitmonth = $dbs->query('SELECT COUNT(visitor_id)FROM visitor_count WHERE MONTHNAME(checkin_date) = MONTHNAME(now()) AND YEAR(checkin_date) = YEAR(now())'); 
    $visitmonth = $visitmonth->fetch_row();
    // Visitor Today
    $visitday = $dbs->query('SELECT COUNT(visitor_id)FROM visitor_count WHERE DATE(checkin_date) = CURDATE()');
    $visitday = $visitday->fetch_row();
    // Visit All
    $visitc = $dbs->query('SELECT COUNT(visitor_id)FROM visitor_count');
    $visitorcount = $visitc->fetch_row();
?>
<div  class="<?= $sysconf['template']['classic_library_disableslide'] ? 'vegas-slide c-header' : 'vegas-slide' ?>" style="position: fixed; background: rgba(0,0,0,0.3); z-index: -1"></div>

      

      <div class="row">
        <div class="col-md-8 order-md-1">
         
          <div class="flex h-screen w-full" id="visitor-counter" >
            <div class="bg-white w-full md:w-1/2 px-8 pt-8 pb-3 flex flex-col justify-between">
        <div>
            <h3 class="font-light mb-2"><?= __('Welcome to ').$sysconf['library_name']; ?></h3>
            <p class="lead">
                <?= __('Please fill your member ID or name.')?>
            </p>

            <div v-if="textInfo !== ''" class="rounded p-2 mt-4 bg-blue-lighter text-blue-darker md:hidden">{{textInfo}}</div>

            <form class="mt-4" @submit.prevent="onSubmit">
                <div class="form-group">
                    <label for="exampleInputEmail1"><?= __('Member ID')?></label>
                    <input v-model="memberId" ref="memberId" autofocus type="text" class="form-control" id="exampleInputEmail1"
                           aria-describedby="emailHelp" placeholder="<?= __('Enter your member ID')?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1"><?= __('Institution')?></label>
                    <input v-model="institution" type="text" class="form-control" id="exampleInputPassword1"
                           placeholder="<?= __('Enter your institution')?>">
                    <small id="emailHelp" class="form-text text-muted"><?= __('Enough fill your member ID if you are member of ').$sysconf['library_name']; ?></small>
                </div>
                <button type="submit" class="btn btn-primary btn-block"><?= __('Check In')?></button>
            </form>
        </div>
        <div class="text-right">
            <small class="text-grey-dark"><?= __('Powered by ')?> <code>SLiMS</code></small>
        </div>
    </div>
            <div class="flex-1 hidden md:block">
              <div class="h-screen">
                <div v-show="textInfo !== ''" class="flex items-center h-screen p-8">
                  <div class="w-32">
                    <div class="w-32 h-32 bg-white rounded-full border-white border-4 shadow">
                      <img :src="image" alt="image" class="rounded-full" @error="onImageError">
                    </div>
                  </div>
                  <div class="px-8">
                    <h3 class="font-light text-white mb-2" v-html="textInfo"></h3>
                  </div>
                </div>
                <div class="flex h-screen items-end p-8">
                <blockquote class="blockquote" v-show="textInfo === ''">
                    <div id="carouselContent" class="carousel slide" data-interval="10000" data-ride="carousel">
                        <div class="carousel-inner text-white" role="listbox">
                            <div class="carousel-item p-4">
                                 <p>Go forth and set the world on fire.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item active p-4">
                                 <p>Finding God in All Things</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>Pray as if God will take care of all; act as if all is up to you.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>Love ought to show itself in deeds more than in words.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>Teach us to give and not to count the cost.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>For those who believe, no proof is necessary. For those who disbelieve, no amount of proof is sufficient.Discouragement is not from God</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>The glory of God is humankind fully alive.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>All the things in this world are gifts of God, created for us, to be the means by which we can come to know him better, love him more surely, and serve him more faithfully.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>God will not be outdone in generosity.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>He who goes about to reform the world must begin with himself, or he loses his labor.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>He who carries God in his heart bears Heaven with him wherever he goes.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>For those who love, nothing is too difficult, especially when it is done for the love of our Lord Jesus Christ.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>You have given it all to me. To you, Lord, I return it. Everything is yours; do with it what you will. Give me only your love and grace. That is enough for me.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>Laugh and grow strong.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>Dearest Lord, teach me to be generous; teach me to serve you as you deserve; to give and not to count the cost.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>To conquer himself is the greatest victory that man can gain.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>Sin is unwillingness to trust that what God wants for me is only my deepest happiness.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>It is not hard to obey when we love the one whom we obey.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>If God causes you to suffer much, it is a sign that He certainly intends to make you a saint.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>If our church is not marked by caring for the poor, the oppressed, the hungry, we are guilty of heresy.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>Teach us, Good Lord, to give and not count the cost; to fight and not to heed the wounds; to toil and not to seek for rest; to labor and not to ask for any reward save that of knowing that we do thy will.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>Occupy yourself in beholding and bewailing your own imperfections rather than contemplating the imperfections of others.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>SPIRITUAL EXERCISES whereby to conquer oneself, and order one’s life, without being influenced in one’s decision by any inordinate affection.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>We must speak to God as a friend speaks to his friend, servant to his master; now asking some favor, now acknowledging our faults, and communicating to Him all that concerns us, our thoughts, our fears, our projects, our desires, and in all things seeking His counsel.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>He who is not getting better is getting worse.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>In the case of those who are making progress from good to better, the good angel touches the soul gently, lightly, sweetly, as a drop of water enters a sponge, while the evil spirit touches it sharply, with noise and disturbance, like a drop of water falling on a rock.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>Let us work as if success depended upon ourselves alone, but with heartfelt conviction that we are doing nothing, and God everything.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>Truth always ends by victory; it is not unassailable, but invincible.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>Ite, inflammate omnia.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>God inclines to shower His graces upon us, but our perverted will is a barrier to His generosity.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>A person with imprecise ideas can understand little and be of less help to others.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>God freely created us so that we might know, love, and serve him in this life and be happy with him forever. God’s purpose in creating us is to draw forth from us a response of love and service here on earth, so that we may attain our goal of everlasting happiness with him in heaven.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>God gives each one of us sufficient grace ever to know His holy will, and to do it fully.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>The more completely we focus our attention on our Creator and Lord, the less chance there is of our being distracted by creatures.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>May God our Lord never let me harm anyone when I cannot help him!</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>The acknowledgment of and gratitude for favors and gifts received is loved and esteemed in Heaven and on earth.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>Receive, Lord, all my liberty, my memory, my understanding and my whole will.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>May it please Christ our Lord to grant us true humility and abnegation of will and judgment, so that we may deserve to begin to be His disciples.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>True, I am in love with suffering, but I do not know if I deserve the honor.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>After you have made a decision that is pleasing to God, the Devil may try to make you have second thoughts. Intensify your prayer time, meditation, and good deeds. For if Satan’s temptations merely cause you to increase your efforts to grow in holiness, he’ll have an incentive to leave you alone.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>One must wage war against his predominant passion and not retreat until, with God’s help, he has been victorious.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>May the perfect grace and eternal love of Christ our Lord be our never-failing protection and help.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>What seems to me white, I will believe black if the hierarchical Church so defines.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>Remember that bodily exercise, when it is well ordered, as I have said, is also prayer by means of which you can please God our Lord.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>Be generous to the poor orphans and those in need. The man to whom our Lord has been liberal ought not to be stingy. We shall one day find in Heaven as much rest and joy as we ourselves have dispensed in this life.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>God our Lord would have us look to the Giver and love Him more than His gift, keeping Him always before our eyes, in our hearts, and in our thoughts.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>It is proper to ask for sorrow with Christ in sorrow, anguish with Christ in anguish, tears and deep grief because of the great affliction Christ endures for me.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            <div class="carousel-item p-4">
                                 <p>We must put aside all judgment of our own, and keep the mind ever ready and prompt to obey in all things the true Spouse of Christ our Lord, our holy Mother, the hierarchical Church.</p>
                                 <footer class="blockquote-footer text-grey-light">Ignatius of Loyola</footer>
                            </div>
                            

                        </div>
                        
                        </a>
                    </div>
                    
                </blockquote>
            </div>
                
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 order-md-2 p-10 mb-4">
        
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Pengunjung Hari Ini</h6>
                <small class="text-muted"><?php echo date('d F Y'); ?></small>
              </div>
              <span class="text-muted"><?php echo $visitday['0'];?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Pengunjung Bulan Ini</h6>
                <small class="text-muted"><?php echo date('F'); ?></small>
              </div>
              <span class="text-muted"><?php echo $visitmonth['0'];?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Pengunjung Tahun ini</h6>
                <small class="text-muted"><?php echo date('Y'); ?></small>
              </div>
              <span class="text-muted"><?php echo $visityear['0'];?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between bg-light">
              <div class="text-success">
                <h6 class="my-0">Total Pengunjung</h6>
                <small>Total Seluruh Pengunjung</small>
              </div>
              <span class="text-success"><?php echo $visitorcount['0'];?></span>
            </li>
            
          </ul>
          
        </div>
      </div>
      

<script src="<?php echo $sysconf['template']['dir'].'/'.$sysconf['template']['theme'].'/assets/js/axios.min.js'; ?>"></script>
<script src="<?= JWB . 'he.js' ?>"></script>
<script>
    new Vue({
        el: '#visitor-counter',
        data() {
            return {
                memberId: '',
                institution: '',
                textInfo: '',
                image: './images/persons/photo.png',
                quotes: {},
                timeout: null
            }
        },
        mounted() {
            this.$refs.memberId.focus()
            this.getQuotes()
        },
        methods: {
            onImageError: function() {
                this.image = './images/persons/photo.png'
            },
            getQuotes: function() {
                // Alternative Free Quotes API: https://api.quotable.io/random
                axios.get('https://kutipan.herokuapp.com/')
                    .then(res => {
                        res.data.content = he.decode(res.data.content)
                        this.quotes = res.data
                    })
                    .catch(() => {
                        this.quotes = {
                            content: "Sing penting madhiang.",
                            author: "Pai-Jo"
                        }
                    })
                    .finally(() => {
                        this.textInfo = ''
                    })
            },
            onSubmit: function() {
                if (this.memberId === '') {
                    this.resetForm()
                    return
                }
                let url = 'index.php?p=visitor'
                let data = new FormData()
                data.append('memberID', this.memberId)
                data.append('institution', this.institution)
                data.append('counter', 1)

                axios({
                    url: url,
                    method: 'post',
                    data: data,
                    headers: {'Content-Type': 'multipart/form-data' }
                })
                    .then(res => {
                        this.textInfo = res.data.message
                        this.image = `./images/persons/${res.data.image}`
                        <?php if ($sysconf['template']['visitor_log_voice']) : ?>
                            this.textToSpeech(this.textInfo.replace(/(<([^>]+)>)/ig, ''))
                        <?php endif; ?>
                    })
                    .catch(err => {
                        console.log(err);
                    })
                    .finally(() => {
                        this.resetForm()
                        clearTimeout(this.timeout)
                        this.timeout = setTimeout(() => {
                            this.getQuotes()
                        }, 5000)
                    })
            },
            resetForm: function () {
                this.memberId = ''
                this.institution = ''
                this.$refs.memberId.focus()
            },
            textToSpeech: function(message) {
                var message = new SpeechSynthesisUtterance(message);
                var voices = speechSynthesis.getVoices();
                // console.log(message);
                message['volume'] = 1;
                message['rate'] = 1;
                message['pitch'] = 1;
                message['lang'] = '<?php echo str_replace('_', '-', $sysconf['default_lang']); ?>';
                message['voice'] = null;
                speechSynthesis.cancel();
                speechSynthesis.speak(message);
            }
        }
    })
</script>
