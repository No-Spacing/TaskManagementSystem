<!DOCTYPE html>
<html>
<head>
    <title>New Inquiry</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        h2 {
            color: #007bff;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background: #007bff;
            color: white;
        }
        p {
            line-height: 1.5;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>New Inquiry Submission</h2>
    <table>
        <tr>
            <th>Field</th>
            <th>Details</th>
        </tr>
        <tr>
            <td><strong>First Name</strong></td>
            <td>{{ $data['firstname'] }}</td>
        </tr>
        <tr>
            <td><strong>Last Name</strong></td>
            <td>{{ $data['lastname'] }}</td>
        </tr>
        <tr>
            <td><strong>Email</strong></td>
            <td>{{ $data['email'] }}</td>
        </tr>
        <tr>
            <td><strong>Organization</strong></td>
            <td>{{ $data['organization'] ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td><strong>Address</strong></td>
            <td>{{ $data['address'] }}</td>
        </tr>
        <tr>
            <td><strong>City</strong></td>
            <td>{{ $data['city'] }}</td>
        </tr>
        <tr>
            <td><strong>Country</strong></td>
            <td>{{ $data['country'] }}</td>
        </tr>
        <tr>
            <td><strong>Message</strong></td>
            <td>{{ $data['message'] }}</td>
        </tr>
    </table>
</div>

</body>
</html>
