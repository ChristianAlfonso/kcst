<!--updates-->
<div class="section updates p-5" id="updates">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header h2">
                                Events
                            </div>
                            <div class="card-body">
                                <?php
                                if ($result_events->num_rows > 0) {
                                    while ($row = $result_events->fetch_assoc()) {
                                        echo "<div class='card mb-3'>";
                                        if (!empty($row['image'])) {
                                            echo "<img src='uploads/" . htmlspecialchars($row['image']) . "' class='card-img-top' alt='Event Image'>";
                                        }
                                        echo "<div class='card-body'>";
                                        echo "<h5 class='card-title'>" . htmlspecialchars($row['title']) . "</h5>";
                                        echo "<p class='card-text'>" . nl2br(htmlspecialchars($row['description'])) . "</p>";
                                        echo "<p class='card-text'><small class='text-muted'>Scheduled on " . $row['event_date'] . "</small></p>";
                                        echo "</div></div>";
                                    }
                                } else {
                                    echo "<p>No events available.</p>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header h2">
                                Announcements
                            </div>
                            <div class="card-body">
                                <?php
                                if ($result_announcements->num_rows > 0) {
                                    while ($row = $result_announcements->fetch_assoc()) {
                                        echo "<div class='card mb-3'>";
                                        echo "<div class='card-body'>";
                                        echo "<h5 class='card-title'>" . htmlspecialchars($row['title']) . "</h5>";
                                        echo "<p class='card-text'>" . nl2br(htmlspecialchars($row['message'])) . "</p>";
                                        echo "<p class='card-text'><small class='text-muted'>Posted on " . $row['created_at'] . "</small></p>";
                                        echo "</div></div>";
                                    }
                                } else {
                                    echo "<p>No announcements available.</p>";
                                }

                                $conn->close();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
