<style>
/* Ensure html and body take full height of the viewport */
html, body {
    height: 100%;
    margin: 0;
}

/* Flexbox layout for the body */
body {
    display: flex;
    flex-direction: column;
    justify-content: space-between;  /* Ensures footer is pushed to the bottom */
}

/* Content area, so it expands and pushes footer down */
.content {
    flex-grow: 1;
}

/* Footer styling */
footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 20px;
    width: 100%;
    font-family: Arial, sans-serif;
}


.footer-content {
    
    max-width: 600px; /* Ensures content does not stretch too wide on large screens */
    margin: 0 auto;
}

.footer-content a {
    color: #FFD700; /* Gold color for the email link */
    text-decoration: none;
}

.footer-content a:hover {
    text-decoration: underline;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    footer {
        padding: 15px; /* Slightly reduced padding on smaller screens */
        position: relative;
    }

    .footer-content {
        padding: 10px;
        font-size: 14px; /* Slightly smaller font on smaller devices */
    }
}

</style>
<br><br>
</div>
<footer>
        <footer>
            <div class="footer-content">
                <p>Developed by <strong>Virat Kohli</strong></p>
                <p>Contact: <a href="mailto:prashantjainvk18@gmail.com">prashantjainvk18@gmail.com</a></p>
            </div>
        </footer>
    </div>
</footer>

</body>
</html>
