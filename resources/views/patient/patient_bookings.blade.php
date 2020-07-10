@foreach($bookings as $booking)
  <table>
    <tr>
      <th>Order ID</th>
      <th>User ID</th>
      <th>Doctor ID</th>
      <th>Clinic ID</th>
      <th>Booking date</th>
      <th>Start time</th>
      <th>Finish time</th>
      <th>Description</th>
      <th>Payment</th>
      <th>Status</th>
    </tr>

    <tr>
      <td>{{ $booking->id }}</td>
      <td>{{ $booking->user_id }}</td>
      <td>{{ $booking->doctor_id }}</td>
      <td>{{ $booking->clinic_id }}</td>
      <td>{{ $booking->booking_date }}</td>
      <td>{{ $booking->time_start }}</td>
      <td>{{ $booking->time_finish }}</td>
      <td>{{ $booking->description }}</td>
      <td>{{ $booking->payment_type }}</td>
      <td>{{ $booking->status }}</td>
    </tr>

  </table>
  <br>
@endforeach
<style>
  table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
  }
</style>