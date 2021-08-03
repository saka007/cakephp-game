<div class="posts index">

<div class="modal fade" id="gameModal" tabindex="-1" aria-labelledby="gameModalLabel" aria-modal="true"
    role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gameModalLabel">GAME UPDATE</h5>
                <button type="button" class="close" aria-label="Close" onclick="closeModal()">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body"></div>
            <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" onclick="location.reload();">PLAY AGAIN</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show" id="backdrop" style="display: none;"></div>

  <div class="d-flex justify-content-center bd-highlight mb-3">
  <div class="row mt-5 mb-5"> 
    
    <div class="col">
     <h4 class="text-center"><?php echo strtoupper($user_data->first()->name);?></h4>
     <div id="yourHealth"><div id="yourHealthBar"></div></div>
    </div>

    
    <div class="col">
        <h4 class="text-center"><?php echo strtoupper('Dragon');?></h4>
        <div id="dragonHealth"><div id="dragonHealthBar"></div></div>
    </div>

    </div>
  </div>
  
   

    <input type="hidden" id="uid" value="<?php echo $user;?>"></input>
    <div class="row mt-2 mb-2"> 
        
        <div class="col-md-12 text-center">
            <button type="button" class="btn btn-primary btn-lg" id="start" onclick="clock();">START THE GAME</button>
            <button type="button" class="btn btn-primary btn-lg" id="playAgain" style="display:none;" onclick="location.reload();">PLAY AGAIN</button>
        </div>

    </div>

    <div id="countdown" class="display-1 text-center"></div>

    <div class="row">
        
        <div class="col-md-12 text-center">
        <div class="bd-example mx-auto">
            <button type="button" class="btn btn-primary" id="attack" onClick="fight(id)">Attack</button>
            <button type="button" class="btn btn-primary" id="powerattack" onClick="fight(id)">Power Attack</button>
            <button type="button" class="btn btn-primary" id="heal" onClick="fight(id)">Heal</button> 
            <button type="button" class="btn btn-primary" id="giveup" onClick="fight(id)">GiveUp</button> 
         </div>
        </div>

    </div>

    

  <div id="announcements"></div>

    <h2 class="display-5 text-center"><?php echo __('PAST RESULTS'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th>SR NO</th>
            <th>GAME RESULT</th>
            <th>PLAYED DATE</th>
        </tr>
        </thead>
        <tbody>
        <?php $id=1; foreach ($history as $user): ?>
            <tr>

                <td><?php echo $id; ?>&nbsp;</td>
                <td><?php echo $user->result; ?>&nbsp;</td>
                <td><?php echo $user->created->format('y-M-d H:m:s'); ?>&nbsp;</td>
    
            </tr>
        <?php $id++; endforeach; ?>
        </tbody>
    </table>
</div>
</div>