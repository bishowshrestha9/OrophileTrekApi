<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Review Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 0 0 5px 5px;
        }
        .review-details {
            background-color: white;
            padding: 15px;
            margin: 15px 0;
            border-left: 4px solid #4CAF50;
        }
        .label {
            font-weight: bold;
            color: #555;
        }
        .rating {
            color: #FFD700;
            font-size: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #777;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>🌟 New Review Received</h2>
    </div>
    
    <div class="content">
        <p>Hello Admin,</p>
        <p>A new review has been submitted on your website. Here are the details:</p>
        
        <div class="review-details">
            <p><span class="label">Name:</span> {{ $review->name }}</p>
            <p><span class="label">Email:</span> {{ $review->email }}</p>
            <p><span class="label">Rating:</span> <span class="rating">{{ str_repeat('⭐', (int)$review->rating) }}</span> ({{ $review->rating }}/5)</p>
            <p><span class="label">Status:</span> {{ $review->status ? 'Approved' : 'Pending Approval' }}</p>
            <p><span class="label">Submitted:</span> {{ $review->created_at->format('F j, Y, g:i a') }}</p>
        </div>
        
        <div class="review-details">
            <p><span class="label">Review:</span></p>
            <p>{{ $review->review }}</p>
        </div>
        
        <p>Please log in to your admin panel to review and moderate this submission.</p>
    </div>
    
    <div class="footer">
        <p>This is an automated notification from {{ config('app.name') }}</p>
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
</body>
</html>
