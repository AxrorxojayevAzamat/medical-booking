@if(Session::get('error')=='1')
	<strong>У вас есть пациент Понедельник, выберите другое время</strong>
@elseif(Session::get('error')=='2')
	<strong>У вас есть пациент Вторник, выберите другое время</strong>
@elseif(Session::get('error')=='3')
	<strong>У вас есть пациент Среда, выберите другое время</strong>
@elseif(Session::get('error')=='4')
	<strong>У вас есть пациент Четверг, выберите другое время</strong>
@elseif(Session::get('error')=='5')
	<strong>У вас есть пациент Пятница, выберите другое время</strong>
@elseif(Session::get('error')=='6')
	<strong>У вас есть пациент Суббота, выберите другое время</strong>
@elseif(Session::get('error')=='7')
	<strong>У вас есть пациент Воскресенье, выберите другое время</strong>
@elseif(Session::get('error')=='odd_even')
		<strong>Выберите нечетные дни или четные дни</strong>
@elseif(Session::get('error')=='odd')
		<strong>Есть бронирование нечетные дни</strong>
@elseif(Session::get('error')=='even')
		<strong>Есть бронирование четные дни</strong>
@endif
