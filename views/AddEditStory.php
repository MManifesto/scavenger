<div class="col-sm-3">                    
    <div class="sidebar-wrapper">
    <h2>Add/Edit Story</h2>
        <i class='glyphicon-spinner glyphicon-spin glyphicon-large'></i>
        <form class="form-horizontal col-sm-12">
            <div class="form-group">
                <label for="inputID" class="control-label">ID</label>
                <input ng-model="storyCtrlFormData.id" type="text" class="form-control" id="inputID" disabled="disabled" maxlength="10">
            </div>
            <div class="form-group">
                <label for="inputName" class="control-label">Name</label>                
                <input ng-model="storyCtrlFormData.name" type="text" class="form-control" id="inputName" placeholder="Enter Name" maxlength="255"></textarea>
            </div>
            <div class="form-group">
               <label for="inputCode" class="control-label">Code</label>
                <input ng-model="storyCtrlFormData.code" type="text" class="form-control" id="inputCode" placeholder="Code" maxlength="255">
            </div>
            <div class="form-group">
               <label for="inputMaxUsers" class="control-label">Max Users</label>
                <input ng-model="storyCtrlFormData.maxUsers" type="text" class="form-control" id="inputMaxUsers" placeholder="MaxUsers" maxlength="255">
            </div>
            <div class="form-group">
                <label for="inputDescription" class="control-label">Description</label>                
                <textarea ng-model="storyCtrlFormData.description" type="text" class="form-control" id="inputDescription" placeholder="Enter description" maxlength="255"></textarea>
            </div>
            <div class="form-group">
                <label for="inputFirstClue" class="control-label">First Clue ID</label>
                <select class="form-control" id="inputFirstClue" ng-model="storyCtrlFormData.clueid">
                    <option ng-repeat='clue in clues | orderObjectBy: "id"' value="{{clue.id}}">{{clue.id}} | {{clue.name}}</option>
                </select>
            </div>
            <div class="form-group">
                <label for="inputDefaultHint" class="control-label">Default Hint Message</label>                
                <textarea ng-model="storyCtrlFormData.hint" type="text" class="form-control" id="inputDefaultHint" placeholder="This hint is displayed if no others are available" maxlength="255"></textarea>
            </div>
            <div class="form-group">
                <label for="inputEndMessage" class="control-label">End Message</label>                
                <textarea ng-model="storyCtrlFormData.end" type="text" class="form-control" id="inputEndMessage" placeholder="This message is displayed when a party finishes every clue in the story" maxlength="255"></textarea>
            </div>
            <div class="form-group">
                <label for="inputType" class="control-label">Type</label>                
                <select class="form-control" id="inputType" ng-model="storyCtrlFormData.type">
                    <option value="0" selected>0 - Default</option>
                    <option value="1">1 - AutoStart with Code</option>
                </select>
            </div>
            <div class="form-group">
                <div>
                    <button ng-click="storyCtrlFormData.submit()" class="btn btn-primary" type="submit">
                        <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
                        Save
                    </button>
                    <button ng-click="storyCtrlFormData.reset()" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>
                        Reset
                    </button>

                    <!-- <pre>{{storyCtrlFormData}}</pre> -->
                </div>
            </div>
        </form>
    </div>
</div>
<div class="col-sm-9">
    <h2>List Stories</h2>
    <br />
    <table ng-show="loaded" class='table table-bordered table-striped lists'>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Code</th>
            <th>Max Users</th>
            <th>First Clue</th>
            <th>Default Hint Message</th>
            <th>End Message</th>
            <th>Type</th>
            <th>Controls</th>
        </tr>
        <tr ng-repeat='item in storyList | orderObjectBy: "id"'>
            <td> {{ item.id }} </td>
            <td> {{ item.name }} </td>
            <td> {{ item.code }}</td>
            <td> {{ item.maxUsers }}</td>
            <td> {{ item.clueid }} </td>
            <td> {{ item.hint }} </td>
            <td> {{ item.end }} </td>
            <td> {{ item.type }}</td>
            <td class="controls">
                <button class="btn btn-success" ng-click='editItem(item)' title="Edit">
                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                </button>

                <button class="btn btn-danger" ng-click='deleteItem(item)' title="Delete">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                </button>
            </td>
        </tr>
    </table>

    <div class="loading-list" ng-hide="loaded"><i class="glyphicon glyphicon-refresh"></i></div>
</div>