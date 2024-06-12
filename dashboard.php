<?php
session_start();
if (isset($_POST['logout'])) {
    unset($_SESSION['user']);
}

if (!isset($_SESSION['user'])) {
    header("Location: sign-in.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>FIT.AI - Dashboard</title>
        <link rel="icon" href="#">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?php include 'header.php'; ?>
        <main>
            <div class="container">
                <h1>Dashboard</h1>
                <div class="hero-dashboard">
                    <div class="left">
                        <form id="fitness-form">
                            <input type="number" id="age" name="age" min="18" max="100" placeholder="Age" required>
                            <br>
                            <input type="number" id="weight" name="weight" min="20" max="300" placeholder="Weight (kg)" required>
                            <br>
                            <input type="number" id="height" name="height" min="50" max="300" placeholder="Height (cm)" required>
                            <br>
                            <button id="submit" type="submit" class="button button--light">Generate Fitness Plan</button>
                        </form>
                    </div>
                    <div class="right">
                        <div id="output"></div>
                        <div id="loader" class="loader-wrapper">
                            <div class="loader"></div>
                        </div>
                    </div>
                </div>
            </div>    
        </main>
        <?php include 'footer.php' ?>
        <script type="importmap">
            {
                "imports": {
                "@google/generative-ai": "https://esm.sh/@google/generative-ai"
                }
            }
        </script>
        <script type="module">
            import { GoogleGenerativeAI } from "@google/generative-ai";
            // Replace "YOUR_API_KEY" with your own gemini api key.
            const API_KEY = "YOUR_API_KEY";
            const genAI = new GoogleGenerativeAI(API_KEY);
            const model = await genAI.getGenerativeModel({ model: "gemini-1.5-flash" });

            function convertToHtml(text) {
                text = text.replace(/## (.*?)\n/g, '<h2>$1</h2>\n');

                text = text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');

                text = text.replace(/\* (.*?)\n/g, '<li>$1</li>\n');

                text = text.replace(/(<li>.*?<\/li>\n)+/g, match => '<ul>\n' + match + '</ul>\n');

                return text;
            }

            const loader = document.getElementById('loader');
            const submitButton = document.getElementById('submit');

            document.getElementById('fitness-form').addEventListener('submit', async function(event) {
                event.preventDefault();

                const age = document.getElementById('age').value;
                const weight = document.getElementById('weight').value;
                const height = document.getElementById('height').value;

                const prompt = `Generate a fitness plan for a person with the following details:\nAge: ${age},\nWeight: ${weight} kg,\nHeight: ${height} cm.`;

                try {
                    loader.classList.add('active');
                    submitButton.disabled = true;
                    document.getElementById('output').textContent = "";
                    const result = await model.generateContent(prompt);
                    if (result && typeof result === 'object') {
                        const content = result.response.candidates[0].content.parts[0].text;
                        const htmlContent = convertToHtml(content);
                        document.getElementById('output').innerHTML = htmlContent;
                    } else {
                        throw new Error("Empty or invalid response received.");
                    }
                } catch (error) {
                    console.error("Error generating fitness plan:", error);
                    document.getElementById('output').textContent = `Failed to generate fitness plan. Error: ${error.message}`;
                }
                finally {
                    loader.classList.remove('active');
                    submitButton.disabled = false;
                }
            });
        </script>
    </body>
</html>
