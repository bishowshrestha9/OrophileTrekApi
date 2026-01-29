<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Orophile Trek API Documentation

Welcome to the Orophile Trek API. This application provides a RESTful API for managing treks and authentication.

## Base URL

`http://localhost:8000` (Development)

## Authentication

The API uses **Laravel Sanctum** for authentication.

*   **Header**: `Authorization: Bearer <your_token>`

Most endpoints related to managing data require authentication.

---

## API Endpoints

### 1. Authentication

#### User Login
Authenticate a user and receive an API token.

*   **Endpoint**: `POST /api/login`
*   **Access**: Public

**Request Body (JSON):**
```json
{
  "email": "user@example.com",
  "password": "password123"
}
```

**Response (200 OK):**
```json
{
  "status": true,
  "message": "Login successful",
  "token": "auth_token_string_here..."
}
```

**Response (401 Unauthorized):**
```json
{
  "status": false,
  "message": "Invalid login details"
}
```

#### User Logout
Invalidate the current user's token.

*   **Endpoint**: `POST /api/logout`
*   **Access**: Protected (Requires Bearer Token)

**Response (200 OK):**
```json
{
  "status": true,
  "message": "Logged out"
}
```

#### Get Authenticated User Info
Retrieve details about the currently logged-in user.

*   **Endpoint**: `GET /api/me`
*   **Access**: Protected (Requires Bearer Token)

**Response (200 OK):**
```json
{
  "status": true,
  "role": "admin"
}
```

---

### 2. Treks & Packages

Manage treks and packages.

#### Get All Treks
Retrieve a paginated list of treks.

*   **Endpoint**: `GET /api/treks`
*   **Access**: Protected

**Query Parameters:**
*   `data_type`: (Optional) Filter by type. Values: `trek`, `package`.
*   `is_active`: (Optional) Filter by data status. Values: `1` (true), `0` (false).

**Response (200 OK):**
```json
{
  "success": true,
  "data": {
    "treks": [
      {
        "id": 1,
        "title": "Everest Base Camp",
        "location": "Solukhumbu",
        "price": 1500,
        "duration": "14 Days",
        "difficulty": "Hard",
        "type": "Adventure",
        "distance_km": 130,
        "description": "A wonderful trek...",
        "featured_image": "http://localhost:8000/treks/image.jpg",
        "is_featured": true,
        "is_active": true,
        "currency": "USD",
        "data_type": "trek",
        "trek_days": ["Day 1: Arrival", "Day 2: Kathmandu"],
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-01-01T00:00:00.000000Z"
      }
    ],
    "pagination": {
      "total": 50,
      "per_page": 10,
      "current_page": 1,
      "last_page": 5
    }
  },
  "message": "Treks retrieved successfully"
}
```

#### Create a New Trek
Store a new trek in the database.

*   **Endpoint**: `POST /api/treks`
*   **Access**: Protected
*   **Content-Type**: `multipart/form-data`

**Request Body (Form Data):**

| Field | Type | Required | Description |
| :--- | :--- | :--- | :--- |
| `title` | String | Yes | Title of the trek/package. |
| `location` | String | Yes | Location/Region. |
| `price` | Number | Yes | Cost. |
| `currency` | String | Yes | E.g., USD, NPR. |
| `duration` | String | Yes | E.g., "5 Days". |
| `difficulty` | String | Yes | E.g., Easy, Medium, Hard. |
| `type` | String | Yes | Type of activity. |
| `distance_km` | Number | Yes | Total distance. |
| `data_type` | String | Yes | `trek` or `package`. |
| `is_featured` | Boolean | Yes | `1` or `0`. |
| `is_active` | Boolean | Yes | `1` or `0`. |
| `trek_days[]` | Array | Yes | Array of day description strings. |
| `description` | String | No | Detailed description. |
| `featured_image` | File | No | Image file (jpg, png, etc.). |

**Response (201 Created):**
```json
{
  "success": true,
  "data": {
    "id": 2,
    "title": "New Trek",
    ...
  },
  "message": "Trek created successfully"
}
```

#### Get Single Trek
Retrieve details of a specific trek.

*   **Endpoint**: `GET /api/treks/{id}`
*   **Access**: Protected

**Response (200 OK):**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Everest Base Camp",
    ...
  },
  "message": "Trek retrieved successfully"
}
```

**Response (404 Not Found):**
```json
{
  "message": "No query results for model [App\\Models\\Trek] {id}"
}
```

#### Update a Trek
Update an existing trek.

*   **Endpoint**: `POST /api/treks/{id}?_method=PUT`
*   **Access**: Protected
*   **Content-Type**: `multipart/form-data` (if uploading image) or `application/x-www-form-urlencoded`

**Note:** To support file uploads via `PUT`, use the `POST` method with `_method=PUT` data or query parameter.

**Request Body:**
Same as specific fields in "Create a New Trek".

**Response (200 OK):**
```json
{
  "success": true,
  "data": { ... },
  "message": "Trek updated successfully"
}
```

#### Delete a Trek
Remove a trek from the database.

*   **Endpoint**: `DELETE /api/treks/{id}`
*   **Access**: Protected

**Response (200 OK):**
```json
{
  "success": true,
  "message": "Trek deleted successfully"
}
```
