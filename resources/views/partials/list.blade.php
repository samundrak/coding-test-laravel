{{-- name,gender,phone,email,address,country,dob,education,contact --}}
<div class="alert alert alert-warning" ng-if="!details.lists.length"> No Details found</div>
<table class="table  table-striped" ng-if="details.lists.length">
<tr>
	<th>SN</th>
	<th>Name</th>
	<th>Gender</th>
	<th>Phone</th>
	<th>Email</th>
	<th>Address</th>
	<th>Country</th>
	<th>Date Of Birth</th>
	<th>Education</th>
	<th>Contact</th>
	<th>Actions	</th>
</tr>
<tr ng-repeat="detail in details.lists">
	<td> @{{ detail.id - 1   }}</td>
	<td> @{{ detail.name  }}</td>
	<td> @{{ detail.gender }}</td>
	<td> @{{ detail.phone }}</td>
	<td>@{{ detail.email }}</td>
	<td>@{{ detail.address }}</td>
	<td>@{{ detail.country }}</td>
	<td>@{{ detail.dob | date:'mm/dd/yyyy'}}</td>
	<td>@{{ detail.education }}</td>
	<td>@{{ detail.contact === 'null' ? ' Not Available' :  detail.contact }}</td>
	<td> 
	<a ui-sref="edit({id:detail.id})" >Edit </a>
	<a ng-click="deleteItem($index,detail)" style="cursor: pointer;" >Delete </a>
	</td>
</tr>
</table>
<pagination ng-if="details.lists.length" total="details.last" span="3" last="details.lists[details.lists.length -1].id"></pagination>