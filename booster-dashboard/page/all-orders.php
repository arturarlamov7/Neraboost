<div class="card">
    <div class="card-body">
        <!-- Order by newest -->

        <div>
            <div
                style="border: 1px solid #111841; display: inline-block; margin-right: 5px; border-radius: 6px; padding: 6px 12px;">
                League of Legends
            </div>
            <div
                style="border: 1px solid rgba(0,0,0,0.2); display: inline-block; margin-right: 5px; border-radius: 6px; padding: 6px 12px; opacity: 0.5;">
                Valorant
            </div>
            <div
                style="border: 1px solid rgba(0,0,0,0.2); display: inline-block; margin-right: 5px; border-radius: 6px; padding: 6px 12px; opacity: 0.5;">
                TFT
            </div>
        </div>

        <?php   
                        $free_orders = $sql->getAll("SELECT * FROM `orders` ORDER BY `date` DESC");

                    // for ($i=0; $i < ; $i++) { 
                    //     # code...
                    // }
                    ?>

        <div style="height: 1px; background: rgba(0, 0, 0, 0.1); margin-top: 20px; margin-bottom: 15px;">
        </div>

        <style>
        .game_order-card {
            margin: 7px 0;
            padding: 10px;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 6px;

        }
        </style>

        <div class="game_order-card">
            <div class="d-flex justify-content-between align-items-center" style="margin-bottom: 15px;">

                <div class="d-flex align-items-center">
                    <b>Rank Boosting</b>

                    <div
                        style="border: 1px solid rgba(0, 0, 0, 0.2); border-radius: 5px; padding: 2px 14px; margin-left: 12px; font-size: 14px;">
                        <img style="height: 16px; margin-right: 4px;"
                            src="https://neraboost.com/template/img/lol-iron.png" alt="">
                        Iron IV (41-60 LP)

                        <i style="opacity: 0.5; margin: 0px 3px;" class="bi bi-chevron-double-right"></i>
                        <!-- <i style="margin: 0px 0px;" class="bi bi-arrow-right-short"></i> -->

                        <img style="height: 16px; margin-left: 4px;"
                            src="https://neraboost.com/template/img/lol-iron.png" alt="">
                        Iron I
                    </div>
                </div>

                <div style="text-transform: uppercase; opacity: 0.7;">#lol-nzdkztyz</div>
            </div>

            <div>
                Added: <b>2023-03-15 12:00 PM</b>
            </div>
            <div>
                Queue: <b>Solo/Duo</b>
            </div>
            <div>
                Server: <b>NA</b>
            </div>
            <div>
                Full payout: <b>32.50$</b>
            </div>
            <div>
                Specific Role: <b>Any</b>
            </div>
            <div>
                Champions: <b>Any</b>
            </div>

            <div style="margin-top: 10px; font-size: 14px; max-width: 500px;">
                <div class="row row-cols-2 g-1">
                    <div class="col">
                        VPN: <b>Yes, NA</b>
                    </div>
                    <div class="col">
                        Flash Position: <b>Default</b>
                    </div>
                    <div class="col">
                        Offline Mode: <b>Yes</b>
                    </div>
                    <div class="col">
                        Priority: <b>Yes</b>
                    </div>
                    <div class="col">
                        Streaming: <b>Yes</b>
                    </div>
                    <div class="col">
                        Coaching: <b>Yes</b>
                    </div>
                </div>
            </div>

            <div style="height: 1px; background: rgba(0, 0, 0, 0.1); margin-top: 15px; margin-bottom: 10px;">
            </div>

            <div class="d-flex justify-content-between">
                <button class="btn btn-dark"
                    style="background: transparent; border-color: red; color: red; border-radius: 30px; padding: 10px 16px; opacity: 0.75;">
                    <i class="bi bi-fire"></i> Priority 2%
                </button>
                <button class="btn btn-primary"
                    style="background: #377dff; border-color: #377dff; border-radius: 30px; padding: 10px 16px;">
                    Take this order
                </button>
            </div>
        </div>

    </div>
</div>