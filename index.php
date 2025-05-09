<?php
/*
Programmer's Details:
Name: Alvendher Joy Francisco Ilar
Student Number: 2022104293
Laboratory Exercise 4: FLAMES and Zodiac Compatibility
Description: This program accepts two names and their birthdays, calculates their zodiac signs
and determines their compatibility using the FLAMES method and Zodiac compatibility.

FLAMES Computation:
1. Count the number of similar letters between the two names
2. Get the remainder when divided by 6
3. Map the remainder to a letter in FLAMES:
   F (1) = Friends     
   L (2) = Lovers  
   A (3) = Anger
   M (4) = Married
   E (5) = Engaged
   S (0) = Soulmates

Zodiac Compatibility:
1. Determines zodiac signs based on birth dates
2. Maps compatibility between zodiac signs into three categories:
   - Great Match: Signs with natural harmony and strong compatibility
   - Favorable Match: Signs with good potential compatibility
   - Not Favorable: Signs that may face relationship challenges
3. Based on traditional astrological elements and qualities of each zodiac sign
*/

// Zodiac class to handle zodiac sign calculations and compatibility
class Zodiac {
    private $sign;          // Stores the zodiac sign
    private $symbol;        // Stores the zodiac symbol
    private $startDate;     // Start date of zodiac sign
    private $endDate;       // End date of zodiac sign
    
    // Constructor takes a date and determines zodiac sign
    public function __construct($date) {
        $month = date('n', strtotime($date));  // Get month number (1-12)
        $day = date('j', strtotime($date));    // Get day of month
        
        // Read zodiac data from external file
        $zodiacData = file('Zodiac.txt', FILE_IGNORE_NEW_LINES);
        foreach ($zodiacData as $line) {
            $data = explode(';', $line);
            if (count($data) < 4) {
                continue; // Skip invalid lines
            }
            
            // Extract sign, symbol, and date range from file data
            $sign = trim($data[0]);
            $symbol = trim($data[1]);
            $startDate = trim($data[2]);
            $endDate = trim($data[3]);
            
            // Parse date range into month and day components
            $startMonth = date('n', strtotime($startDate));
            $startDay = (int)date('j', strtotime($startDate));
            $endMonth = date('n', strtotime($endDate));
            $endDay = (int)date('j', strtotime($endDate));
            
            // Check if current date falls within this zodiac's range
            if (($month == $startMonth && $day >= $startDay) || 
                ($month == $endMonth && $day <= $endDay) ||
                ($month > $startMonth && $month < $endMonth) ||
                ($startMonth > $endMonth && ($month > $startMonth || $month < $endMonth))) {
                               $this->sign = $sign;
                $this->symbol = $symbol;
                $this->startDate = "$startMonth/$startDay";
                $this->endDate = "$endMonth/$endDay";
                break;
            }
        }
    }

    // Getter method for zodiac sign
    public function getSign() {
        return $this->sign;
    }

    // Method to determine zodiac compatibility between two signs
    public function computeZodiacCompatibility($otherZodiac) {
        // Compatibility mapping for all zodiac sign combinations
        $compatibilityMap = [
            'Aries' => [
                'Aries' => 'Great Match',
                'Leo' => 'Great Match', 
                'Sagittarius' => 'Great Match',
                'Taurus' => 'Not Favorable',
                'Virgo' => 'Not Favorable',
                'Capricornus' => 'Not Favorable',
                'Gemini' => 'Great Match',
                'Libra' => 'Great Match',
                'Aquarius' => 'Great Match',
                'Cancer' => 'Not Favorable',
                'Scorpio' => 'Not Favorable',
                'Pisces' => 'Favorable Match'
            ],
            'Taurus' => [
                'Aries' => 'Not Favorable',
                'Leo' => 'Not Favorable',
                'Sagittarius' => 'Not Favorable', 
                'Taurus' => 'Great Match',
                'Virgo' => 'Great Match',
                'Capricornus' => 'Great Match',
                'Gemini' => 'Not Favorable',
                'Libra' => 'Favorable Match',
                'Aquarius' => 'Not Favorable',
                'Cancer' => 'Great Match',
                'Scorpio' => 'Great Match',
                'Pisces' => 'Great Match'
            ],
            'Gemini' => [
                'Aries' => 'Great Match',
                'Leo' => 'Great Match',
                'Sagittarius' => 'Great Match',
                'Taurus' => 'Not Favorable',
                'Virgo' => 'Favorable Match',
                'Capricornus' => 'Not Favorable',
                'Gemini' => 'Great Match',
                'Libra' => 'Great Match', 
                'Aquarius' => 'Great Match',
                'Cancer' => 'Not Favorable',
                'Scorpio' => 'Not Favorable',
                'Pisces' => 'Not Favorable'
            ],
            'Cancer' => [
                'Aries' => 'Not Favorable',
                'Leo' => 'Not Favorable',
                'Sagittarius' => 'Not Favorable',
                'Taurus' => 'Great Match',
                'Virgo' => 'Great Match',
                'Capricornus' => 'Great Match',
                'Gemini' => 'Not Favorable',
                'Libra' => 'Not Favorable',
                'Aquarius' => 'Not Favorable',
                'Cancer' => 'Great Match',
                'Scorpio' => 'Great Match',
                'Pisces' => 'Great Match'
            ],
            'Leo' => [
                'Aries' => 'Great Match',
                'Leo' => 'Great Match',
                'Sagittarius' => 'Great Match',
                'Taurus' => 'Not Favorable',
                'Virgo' => 'Not Favorable',
                'Capricornus' => 'Not Favorable',
                'Gemini' => 'Great Match',
                'Libra' => 'Great Match',
                'Aquarius' => 'Favorable Match',
                'Cancer' => 'Not Favorable',
                'Scorpio' => 'Not Favorable',
                'Pisces' => 'Not Favorable'
            ],
            'Virgo' => [
                'Aries' => 'Not Favorable',
                'Leo' => 'Not Favorable',
                'Sagittarius' => 'Not Favorable',
                'Taurus' => 'Great Match',
                'Virgo' => 'Great Match',
                'Capricornus' => 'Great Match',
                'Gemini' => 'Favorable Match',
                'Libra' => 'Not Favorable',
                'Aquarius' => 'Not Favorable',
                'Cancer' => 'Great Match',
                'Scorpio' => 'Great Match',
                'Pisces' => 'Great Match'
            ],
            'Libra' => [
                'Aries' => 'Great Match',
                'Leo' => 'Great Match',
                'Sagittarius' => 'Great Match',
                'Taurus' => 'Favorable Match',
                'Virgo' => 'Not Favorable',
                'Capricornus' => 'Not Favorable',
                'Gemini' => 'Great Match',
                'Libra' => 'Great Match',
                'Aquarius' => 'Great Match',
                'Cancer' => 'Not Favorable',
                'Scorpio' => 'Not Favorable',
                'Pisces' => 'Not Favorable'
            ],
            'Scorpio' => [
                'Aries' => 'Not Favorable',
                'Leo' => 'Not Favorable',
                'Sagittarius' => 'Not Favorable',
                'Taurus' => 'Great Match',
                'Virgo' => 'Great Match',
                'Capricornus' => 'Great Match',
                'Gemini' => 'Not Favorable',
                'Libra' => 'Not Favorable',
                'Aquarius' => 'Not Favorable',
                'Cancer' => 'Great Match',
                'Scorpio' => 'Great Match',
                'Pisces' => 'Great Match'
            ],
            'Sagittarius' => [
                'Aries' => 'Great Match',
                'Leo' => 'Great Match',
                'Sagittarius' => 'Great Match',
                'Taurus' => 'Not Favorable',
                'Virgo' => 'Not Favorable',
                'Capricornus' => 'Not Favorable',
                'Gemini' => 'Great Match',
                'Libra' => 'Great Match',
                'Aquarius' => 'Great Match',
                'Cancer' => 'Not Favorable',
                'Scorpio' => 'Not Favorable',
                'Pisces' => 'Not Favorable'
            ],
            'Capricornus' => [
                'Aries' => 'Not Favorable',
                'Leo' => 'Not Favorable',
                'Sagittarius' => 'Not Favorable',
                'Taurus' => 'Great Match',
                'Virgo' => 'Great Match',
                'Capricornus' => 'Great Match',
                'Gemini' => 'Not Favorable',
                'Libra' => 'Not Favorable',
                'Aquarius' => 'Not Favorable',
                'Cancer' => 'Great Match',
                'Scorpio' => 'Great Match',
                'Pisces' => 'Great Match'
            ],
            'Aquarius' => [
                'Aries' => 'Great Match',
                'Leo' => 'Favorable Match',
                'Sagittarius' => 'Great Match',
                'Taurus' => 'Not Favorable',
                'Virgo' => 'Not Favorable',
                'Capricornus' => 'Not Favorable',
                'Gemini' => 'Great Match',
                'Libra' => 'Great Match',
                'Aquarius' => 'Great Match',
                'Cancer' => 'Not Favorable',
                'Scorpio' => 'Not Favorable',
                'Pisces' => 'Not Favorable'
            ],
            'Pisces' => [
                'Aries' => 'Favorable Match',
                'Leo' => 'Not Favorable',
                'Sagittarius' => 'Not Favorable',
                'Taurus' => 'Great Match',
                'Virgo' => 'Great Match',
                'Capricornus' => 'Great Match',
                'Gemini' => 'Not Favorable',
                'Libra' => 'Not Favorable',
                'Aquarius' => 'Not Favorable',
                'Cancer' => 'Great Match',
                'Scorpio' => 'Great Match',
                'Pisces' => 'Great Match'
            ]
        ];

        // Return 'Unknown' if either sign is not found
        if ($this->sign === null || $otherZodiac->getSign() === null) {
            return 'Unknown';
        }

        // Return compatibility from map
        return $compatibilityMap[$this->sign][$otherZodiac->getSign()];
    }
}

// Person class to store individual's details and zodiac sign
class Person {
    private $firstName;     // First name of person
    private $lastName;      // Last name of person 
    private $birthday;      // Birthday of person
    private $zodiac;        // Zodiac sign object

    // Constructor initializes person's details and calculates zodiac sign
    public function __construct($firstName, $lastName, $birthday) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthday = $birthday;
        $this->zodiac = new Zodiac($birthday);
    }

    // Returns full name in "LastName, FirstName" format
    public function getFullName() {
        return $this->lastName . ", " . $this->firstName;
    }

    // Returns person's zodiac sign object
    public function getZodiac() {
        return $this->zodiac;
    }
}

// Function to calculate FLAMES relationship result
function calculateFlames($name1, $name2) {
    // FLAMES mapping array - index corresponds to remainder
    $flamesMap = array(
        0 => "Soulmates",   // S
        1 => "Friends",     // F
        2 => "Lovers",      // L
        3 => "Anger",       // A
        4 => "Married",     // M
        5 => "Engaged"      // E
    );
    
    // Convert names to lowercase and remove spaces for comparison
    $name1 = strtolower(str_replace(' ', '', $name1));
    $name2 = strtolower(str_replace(' ', '', $name2));
    
    // Initialize variables for counting common letters
    $commonCount = 0;
    $usedLetters = array();
    
    // Loop through each letter in name1
    for ($i = 0; $i < strlen($name1); $i++) {
        $letter = $name1[$i];
        // If letter exists in name2 and hasn't been counted yet
        if (strpos($name2, $letter) !== false && !isset($usedLetters[$letter])) {
            // Count occurrences in both names
            $count1 = substr_count($name1, $letter);
            $count2 = substr_count($name2, $letter);
            // Add minimum count to total
            $commonCount += min($count1, $count2);
            // Mark letter as counted
            $usedLetters[$letter] = true;
        }
    }
    
    // Get remainder when divided by 6
    $remainder = $commonCount % 6;
    
    // Return corresponding FLAMES result
    return $flamesMap[$remainder];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>FLAMES Calculator</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-pink: #FFB5D6;
            --secondary-orange: #FFB17A; 
            --accent-green: #A8E6CF;
            --accent-blue: #B6DCF2;
            --text-color: #2C3E50;
            --background: #FFF9F4;
            --card-bg: #FFFFFF;
            --shadow: rgba(0, 0, 0, 0.1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            transition: all 0.3s ease;
            cursor: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='%23FF69B4' viewBox='0 0 16 16'><path d='M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z'/></svg>") 16 16, auto;
        }

        body {
            font-family: 'Poppins', 'Nunito', 'Quicksand', 'Varela Round', sans-serif;
            color: var(--text-color);
            background-color: var(--background);
            background-image: radial-gradient(var(--accent-blue) 2px, transparent 2px),
                            radial-gradient(var(--primary-pink) 2px, transparent 2px);
            background-size: 40px 40px;
            background-position: 0 0, 20px 20px;
            min-height: 100vh;
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        h1 {
            font-family: 'Poppins', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            font-size: 3.2rem;
            text-align: center;
            margin-bottom: 2rem;
            color: var(--text-color);
            text-shadow: 3px 3px 0px var(--primary-pink);
        }

        .calculator-container {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 30px var(--shadow);
            border: 3px solid var(--accent-green);
            position: relative;
            overflow: hidden;
        }

        .calculator-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-pink), var(--secondary-orange), var(--accent-green), var(--accent-blue));
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text-color);
        }

        input {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid var(--accent-green);
            border-radius: 8px;
            font-size: 1rem;
            background-color: rgba(255, 255, 255, 0.9);
        }

        input:focus {
            outline: none;
            border-color: var(--accent-blue);
            box-shadow: 0 0 10px var(--shadow);
        }

        input[type="submit"] {
            background: linear-gradient(90deg, var(--primary-pink), var(--secondary-orange), var(--accent-green), var(--accent-blue));
            color: var(--text-color);
            font-weight: 600;
            padding: 0.8rem;
            cursor: pointer;
            border: none;
            border-radius: 25px;
            transition: transform 0.2s;
        }

        input[type="submit"]:hover {
            transform: translateY(-2px);
        }

        .result {
            margin-top: 2rem;
            padding: 2rem;
            background: var(--card-bg);
            border-radius: 15px;
            border: 3px solid var(--accent-blue);
        }

        .flames-explanation, .zodiac-explanation {
            background: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            border: 2px dashed var(--primary-pink);
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin: 1.5rem 0;
            border-radius: 10px;
            overflow: hidden;
            border: 2px solid var(--accent-green);
        }

        th {
            background-color: var(--accent-blue);
            color: var(--text-color);
            padding: 1rem;
            font-weight: 600;
        }

        td {
            padding: 0.8rem;
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid var(--accent-green);
        }

        .zodiac-images {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 3rem;
            margin: 2rem auto;
            padding: 1.5rem;
            background: linear-gradient(135deg, var(--primary-pink) 0%, var(--accent-blue) 100%);
            border-radius: 15px;
            max-width: 900;
            text-align: center;
        }

        .zodiac-image {
            width: 250px;
            height: 250px;
            object-fit: contain;
            background: white;
            padding: 15px;
            border-radius: 50%;
            box-shadow: 0 5px 15px var(--shadow);
        }

        @media (max-width: 768px) {
            body {
                padding: 20px;
            }

            h1 {
                font-size: 2.2rem;
            }

            .calculator-container {
                padding: 1.5rem;
            }

            .zodiac-images {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <h1> Compatibility Calculator </h1>
    
    <div class="calculator-container">
        <!-- Rest of the HTML content remains exactly the same -->
        <!-- FLAMES explanation section -->
        <div class="flames-explanation">
            <h3>How FLAMES Works:</h3>
            <p>1. We count the number of common letters between your names</p>
            <p>2. The total count is divided by 6, and we use the remainder</p>
            <p>3. The remainder maps to a letter in FLAMES:</p>
            <table class="flames-table">
                <tr>
                    <th>Remainder</th>
                    <th>Letter</th>
                    <th>Meaning</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>F</td>
                    <td>Friends</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>L</td>
                    <td>Lovers</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>A</td>
                    <td>Anger</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>M</td>
                    <td>Married</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>E</td>
                    <td>Engaged</td>
                </tr>
                <tr>
                    <td>0</td>
                    <td>S</td>
                    <td>Soulmates</td>
                </tr>
            </table>
        </div>

        <!-- Zodiac explanation section -->
        <div class="zodiac-explanation">
            <h3>How Zodiac Compatibility Works:</h3>
            <p>Your zodiac sign is determined by your birth date. The compatibility between two zodiac signs falls into three categories:</p>
            <ul>
                <li><strong>Great Match:</strong> These signs have natural harmony and strong compatibility</li>
                <li><strong>Favorable Match:</strong> These signs have good potential for compatibility with some effort</li>
                <li><strong>Not Favorable:</strong> These signs may face challenges in their relationship</li>
            </ul>
            <p>The compatibility is based on traditional astrological elements and qualities of each zodiac sign.</p>
            
            <!-- Zodiac compatibility table -->
            <table class="zodiac-table">
                <tr>
                    <th>Zodiac Sign</th>
                    <th>Great Match</th>
                    <th>Favorable Match</th>
                    <th>Not Favorable</th>
                </tr>
                <tr>
                    <td>Aries</td>
                    <td>Aries, Leo, Sagittarius, Gemini, Libra, Aquarius</td>
                    <td>Pisces</td>
                    <td>Taurus, Virgo, Capricornus, Cancer, Scorpio</td>
                </tr>
                <tr>
                    <td>Taurus</td>
                    <td>Taurus, Virgo, Capricornus, Cancer, Scorpio, Pisces</td>
                    <td>Libra</td>
                    <td>Aries, Leo, Sagittarius, Gemini, Aquarius</td>
                </tr>
                <tr>
                    <td>Gemini</td>
                    <td>Aries, Leo, Sagittarius, Gemini, Libra, Aquarius</td>
                    <td>Virgo</td>
                    <td>Taurus, Capricornus, Cancer, Scorpio, Pisces</td>
                </tr>
                <tr>
                    <td>Cancer</td>
                    <td>Taurus, Virgo, Capricornus, Cancer, Scorpio, Pisces</td>
                    <td>-</td>
                    <td>Aries, Leo, Sagittarius, Gemini, Libra, Aquarius</td>
                </tr>
                <tr>
                    <td>Leo</td>
                    <td>Aries, Leo, Sagittarius, Gemini, Libra</td>
                    <td>Aquarius</td>
                    <td>Taurus, Virgo, Capricornus, Cancer, Scorpio, Pisces</td>
                </tr>
                <tr>
                    <td>Virgo</td>
                    <td>Taurus, Virgo, Capricornus, Cancer, Scorpio, Pisces</td>
                    <td>Gemini</td>
                    <td>Aries, Leo, Sagittarius, Libra, Aquarius</td>
                </tr>
                <tr>
                    <td>Libra</td>
                    <td>Aries, Leo, Sagittarius, Gemini, Libra, Aquarius</td>
                    <td>Taurus</td>
                    <td>Virgo, Capricornus, Cancer, Scorpio, Pisces</td>
                </tr>
                <tr>
                    <td>Scorpio</td>
                    <td>Taurus, Virgo, Capricornus, Cancer, Scorpio, Pisces</td>
                    <td>-</td>
                    <td>Aries, Leo, Sagittarius, Gemini, Libra, Aquarius</td>
                </tr>
                <tr>
                    <td>Sagittarius</td>
                    <td>Aries, Leo, Sagittarius, Gemini, Libra, Aquarius</td>
                    <td>-</td>
                    <td>Taurus, Virgo, Capricornus, Cancer, Scorpio, Pisces</td>
                </tr>
                <tr>
                    <td>Capricornus</td>
                    <td>Taurus, Virgo, Capricornus, Cancer, Scorpio, Pisces</td>
                    <td>-</td>
                    <td>Aries, Leo, Sagittarius, Gemini, Libra, Aquarius</td>
                </tr>
                <tr>
                    <td>Aquarius</td>
                    <td>Aries, Sagittarius, Gemini, Libra, Aquarius</td>
                    <td>Leo</td>
                    <td>Taurus, Virgo, Capricornus, Cancer, Scorpio, Pisces</td>
                </tr>
                <tr>
                    <td>Pisces</td>
                    <td>Taurus, Virgo, Capricornus, Cancer, Scorpio, Pisces</td>
                    <td>Aries</td>
                    <td>Leo, Sagittarius, Gemini, Libra, Aquarius</td>
                </tr>
            </table>
        </div>
        
        <!-- Input form for user details -->
        <form method="post" id="compatibilityForm">
            <br>
            <p style="text-align: center; margin-bottom: 2rem; font-size: 1.2rem;">Ready to discover your love compatibility? Fill out the form below to find out if you're destined to be together! ✨</p>
            <div class="form-group">
                <label>&nbsp;&nbsp;<strong>Your First Name:</strong></label>
                <input type="text" name="fname1" required placeholder="Enter your first name...">
            </div>
            <div class="form-group">
                <label>&nbsp;<strong>Your Last Name:</strong></label>
                <input type="text" name="lname1" required placeholder="Enter your last name...">
            </div>
            <div class="form-group">
                <label>&nbsp;<strong>Your Birthday:</strong></label>
                <input type="date" name="bday1" required>
            </div>
            <div class="form-group">
                <label>&nbsp;<strong>Crush's First Name:</strong></label>
                <input type="text" name="fname2" required placeholder="Enter your crush's first name...">
            </div>
            <div class="form-group">
                <label>&nbsp;<strong>Crush's Last Name:</strong></label>
                <input type="text" name="lname2" required placeholder="Enter your crush's last name...">
            </div>
            <div class="form-group">
                <label>&nbsp;<strong>Crush's Birthday:</strong></label>
                <input type="date" name="bday2" required>
            </div>
            <input type="submit" value="Calculate Love Match">
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $person1 = new Person($_POST["fname1"], $_POST["lname1"], $_POST["bday1"]);
        $person2 = new Person($_POST["fname2"], $_POST["lname2"], $_POST["bday2"]);
        
        $zodiacCompatibility = $person1->getZodiac()->computeZodiacCompatibility($person2->getZodiac());
        $relationship = calculateFlames($person1->getFullName(), $person2->getFullName());
        
        echo "<div class='result'>";
        echo "<h2>Love Match Results</h2>";
        echo "<p><strong>" . $person1->getFullName() . "</strong> (Zodiac: " . $person1->getZodiac()->getSign() . 
             ") and <strong>" . $person2->getFullName() . "</strong> (Zodiac: " . $person2->getZodiac()->getSign() . ")</p>";
        echo "<p>Zodiac Compatibility: <strong>$zodiacCompatibility</strong></p>";
        echo "<p>FLAMES Result: <strong>$relationship</strong></p>";
        
        echo "<div class='zodiac-images'>";
        echo "<div>";
        echo "<img src='images/" . strtolower($person1->getZodiac()->getSign()) . ".png' alt='" . $person1->getZodiac()->getSign() . "' class='zodiac-image'>";
        echo "<p class='text-center'><strong>" . $person1->getFullName() . "'s</strong> Zodiac</p>";
        echo "</div>";
        echo "<div>";
        echo "<img src='images/" . strtolower($person2->getZodiac()->getSign()) . ".png' alt='" . $person2->getZodiac()->getSign() . "' class='zodiac-image'>";
        echo "<p class='text-center'><strong>" . $person2->getFullName() . "'s</strong> Zodiac</p>";
        echo "</div>";
        echo "</div>";
        
        $name1_lower = strtolower(str_replace(' ', '', $person1->getFullName()));
        $name2_lower = strtolower(str_replace(' ', '', $person2->getFullName()));
        $common_letters = array();
        
        for ($i = 0; $i < strlen($name1_lower); $i++) {
            $letter = $name1_lower[$i];
            if (strpos($name2_lower, $letter) !== false && !in_array($letter, $common_letters)) {
                $common_letters[] = $letter;
            }
        }
        
        if (!empty($common_letters)) {
            echo "<p>Letters of Destiny: <strong>" . strtoupper(implode($common_letters)) . "</strong></p>";
        }
        echo "</div>";
    }
    ?>

    
</body>
</html>
