{{-- name,gender,phone,email,address,country,dob,education,contact --}}

<div class="alert alert alert-warning" ng-if="!details.lists.length"> No Details found</div>
<table class="table table-stripped" ng-if="details.lists.length">
<tr>
	<th>Name</th>
	<th>Gender</th>
	<th>Phone</th>
	<th>Email</th>
	<th>Address</th>
	<th>Country</th>
	<th>Date Of Birth</th>
	<th>Education</th>
	<th>Contact</th>
</tr>
<tr ng-repeat="detail in details.lists">
	<td> @{{ detail.name  }}</td>
	<td> @{{ detail.gender }}</td>
	<td> @{{ detail.phone }}</td>
	<td>@{{ detail.email }}</td>
	<td>@{{ detail.address }}</td>
	<td>@{{ detail.country }}</td>
	<td>@{{ detail.dob }}</td>
	<td>@{{ detail.education }}</td>
	<td>@{{ detail.contact === 'null' ? ' Not Available' :  detail.contact }}</td>
</tr>
</table>
@{{details.last}}
<pagination total="details.last" span="3" last="3"></pagination>