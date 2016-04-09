<form ng-submit="submitDetails()">
<ul class="list-group">
<li class="list-group-item">
Enter Name
	<input type="text" ng-model="details.name" class="form-control" />
</li>
<li class="list-group-item">
Gender
<br/>	
	<input ng-init="details.gender='male'" type="radio" ng-model="details.gender" value="male"   name="gender"/> Male
	<input type="radio" ng-model="details.gender" value="femalle" name="gender" /> Female
</li>
<li class="list-group-item">
Phone
	<input type="number" ng-model="details.phone" class="form-control" />
</li>
<li class="list-group-item">
Email
	<input type="email" ng-model="details.email" class="form-control" />
</li>
<li class="list-group-item">
Address
	<input type="text" ng-model="details.address" class="form-control"  />
</li>
<li class="list-group-item">
Natinality
	<input type="text" ng-model="details.country" class="form-control"  />
</li>
<li class="list-group-item">
Date Of Birth
	<input type="date" ng-model="details.dob" class="form-control"  />
</li>
<li class="list-group-item">
Education Background
	<input type="text" ng-model="details.education" class="form-control"  />
</li>
<li class="list-group-item">
Prefered mode of Contact
	<br/>
	<input type="checkbox"  ng-model="isContact"/>
	<label class="label label-default" for="checkbox">I have contact</label>
	<br/>
	<br/>
	<input type="text" ng-if="isContact"  ng-model="details.contact" class="form-control" />
</li>
<li class="list-group-item">
	<input type="submit" value="Submit"  class="btn btn-primary" />
</li>

</ul>
</form>