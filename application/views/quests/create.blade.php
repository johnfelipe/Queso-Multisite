@layout('layouts.default')
@section('content')
@if(!empty($quest['skills']))
		<a name="createquest"></a>
		<div class="btn-group pager pull-right hidden-phone">
		  <button class="btn btn-mini btn-primary pager-previous disabled">Previous</button>
		  <button class="btn btn-mini page active">Type</button>
		  <button class="btn btn-mini page disabled">Info</button>
		  <button class="btn btn-mini page disabled">Skills</button>
		  <button class="btn btn-mini page disabled">Rewards</button>
		  <button class="btn btn-mini page disabled">Thresholds</button>
		  <button class="btn btn-mini page disabled">Category</button>
		  <button class="btn btn-mini page disabled">Files</button>
		  <button class="btn btn-mini btn-primary pager-next">Next</button>
		
		</div>
		

		<h2>Create Quest</a></h2>

		{{ Form::open('admin/quest/create', 'POST', array('class' => 'well', 'id' => 'create-quest')); }}

	<fieldset>
	
	<div class="control-group" id="quest-types">	
		<p class="">What kind of quest is this?</p>

			<div class="controls">
			{{ Form::select('type', $quest['types'], '', array('class' => 'chzn-select', 'data-placeholder' => 'Choose a quest type')) }}
			</div>
			<div class="help-block">
				<dl>
					<dt>In Class<dt>
					<dd>Assignments that are handed in or completed during class.  Students will be able to see the quest description but ultimately will rely upon you to assign the completed quest to them.</dd>
					<br/>
					<dt>File Upload</dt>
			 		<dd>Assignments that require a file to be uploaded to the server.  Students submit online and you will be able to download the file from Queso and grade it.</dd>
					<br/>

					<dt>Written</dt>
					<dd>Assignments that can be written and submitted online.  Students will be able to use a WYSIWYG editor to write in a textbox, you will be able to view their work from Queso and grade it.</dd>
					<br/>

				</dl>
			</div>
			<div class="form-actions">
			<a href="#createquest" class="btn pull-right next-step">Next</a>
			</div>

		</div>
	
	<div class="control-group" id="quest-info" style="display:none">	

			<div class="controls">
			    {{ Form::text('title', '', array('placeholder' => 'Quest Name', 'class' => 'input-xxlarge', 'id' => 'quest-name', 'required' => '', 'title' => 'Quest name')); }}
		<p class="">When a student views a quest online, this is the set of instructions they'll see. This could be a prompt for writing, a guideline for an upload, or whatever else you want your students to do.</p>
			<div class="controls">
	
			    {{ Form::textarea('body', '', array('placeholder' => 'Instructions go here...', 'class' => 'wysiwyg-area', 'id' => 'quest-instructions', 'required' => '', 'style' => 'width: 98%', 'title' => 'Quest instructions')); }}
			</div>


			</div>
		<div class="form-actions">
		<a href="#createquest" class="btn pull-right next-step">Next</a>
		</div>

	</div>
	
	
	<div class="control-group" id="quest-skills" style="display:none">	
		<p class="">When a quest is completed by a student, you are able to assign them points for each selected skill.  What skills should be achieved by completing this quest?</p>
			<div class="controls">
			{{ Form::select('skills[]', $quest['skills'], '', array('class' => 'chzn-select', 'id' => 'skills-select', 'data-placeholder' => 'Choose skills', 'multiple', 'required' => '', 'title' => 'Quest skills')) }}
			</div>
		<div class="form-actions">
		<a href="#createquest" class="btn pull-right next-step">Next</a>
		</div>

	</div>
	
	
		<div class="control-group" id="quest-skills-rewards" style="display:none">	
		<p class="">Upon completing a quest, a student is rewarded with points in the skills associated with the quest.  When you grade an attempted quest, you'll be able to assign points per skill based upon the values you create here. Labels show up for you when grading a quest in a drop down list.  Students only see the amount of points rewarded.  <em>You must add skill point values in order to assign points to a quest.</em></p>
			<div class="controls">
				<p><strong>You can't assign rewards unless the quest has skills associated with it.</strong></p>
			</div>
		<div class="form-actions">
		<a href="#createquest" class="btn pull-right next-step">Next</a>
		</div>

	</div>
	
	<div class="control-group" id="quest-threshold" style="display:none">
		<p class="">By default, quests are available to all students.  Sometimes a quest should only be available to students that have achieved a certain level or higher.  If you want to limit the availability of this quest to a higher skill level, you can set it here.</p>
			@foreach($quest['skills'] as $key => $skill)
			<div class="controls" style="margin-bottom: 10px">
			<?php echo Form::label('skill_type', $skill, array('class' => 'control-label pull-left', 'style' => 'width:150px')); ?>


			{{ Form::select('threshold_skill_level['.$key.'][]', $quest['levels'], '', array('class' => 'chzn-select', 'data-placeholder' => 'No Threshold', 'tabindex' => '-1')) }}
			</div>	
			@endforeach

		<div class="form-actions">
		<a href="#createquest" class="btn pull-right next-step">Next</a>
		</div>

	</div>
	<datalist id="categories">
	@foreach ($quest['categories'] as $category)
		<option value="{{$category->category}}">
	@endforeach
	</datalist>
	<div class="control-group" id="quest-category" style="display:none">	
		<p class="">Quests can be grouped into categories.  If you'd like to group this quest into a category, just type in the name.</p>
			<div class="controls">
			    {{ Form::text('category', '', array('placeholder' => 'Category name', 'class' => 'input-xxlarge', 'list' => 'categories', 'autocomplete' => 'off')); }}
			</div>
		<div class="form-actions">
		<a href="#createquest" class="btn pull-right next-step">Next</a>
		</div>
	</div>
	
	<div class="control-group" id="quest-files" style="display:none">
		<p class="">You can attach supplemental files to each quest.  For example, a web design class might include a starter template.  A math class might have a handout with formulas.</p>
			<div class="controls">
				<input type="filepicker-dragdrop" name="files" data-fp-button-text="Add Files" data-fp-services="COMPUTER,DROPBOX,BOX,GOOGLE_DRIVE,GMAIL" data-fp-multiple="true"/>
			</div>
	<div class="form-actions">
	    <?php echo Form::submit('Create Quest', array('class' => 'btn btn-primary pull-right btn-large validated-submission'));?>
	</div>

	</div>


	
	
	</fieldset>

<?php echo Form::close(); ?>
@else
<h2>Create Quest</h2>
<p>You need to create skills before you can create a quest!</p>
<a href="{{URL::to('admin/skills')}}" class="btn btn-large btn-primary pull-right">Create Skills</a>
@endif
@endsection