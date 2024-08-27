{{ include('layouts/header.php' , {title: 'Administration', navActive:'admin'}) }}

<section>
<h1>Journal de bord</h1>
</section>
<section class="label-list">

   <table>
        <tr>
            <th>Adresse IP</th>
            <th>Username</th>
            <th>URI</th>
            <th>Date</th>
        </tr>
        
        {% for log in logs %}
            <tr>
                <td>{{ log.ipAddress }}</td>
                <td>{{ log.username }}</td>
                <td>{{ log.page }}</td>
                <td>{{ log.createTimestamp }}</td>
            </tr>
        {% endfor %}
    </table>
</section>

{{ include('layouts/footer.php')}}